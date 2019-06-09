<?php

namespace Tomebuddy\Vivaldi\Description;

use Tomebuddy\Vivaldi\Description\DescriptorContract;
use Tomebuddy\Vivaldi\Description\ItemsMissingException;

class Descriptor implements DescriptorContract
{
    /**
     * The validation rules described by the descriptor.
     * The expected structure is the following :
     * [
     *     'item1' => [
     *         'rules' => [
     *             'rule1', 'rule2'
     *         ],
     *         'messages' => [
     *             'message1', 'message2'
     *         ]
     *     ],
     *     'item2' => [
     *         'rules' => [
     *             'rule1', 'rule2'
     *         ],
     *         'messages' => [
     *             'message1', 'message2'
     *         ]
     *     ],
     * ]
     *
     * @var array
     */
    protected $items = null;

    /**
     * The static instance
     *
     * @var Tomebuddy\Vivaldi\Description\Descriptor
     */
    protected static $instance = null;

    /**
     * Constructor
     *
     * @param  array $items
     * @return void
     *
     * @throws Tombebuddy\Vivaldi\Description\ItemsMissingException
     */
    public function __construct($items = null)
    {
        if ($items !== null) {
            $this->items = $items;
        }

        $this->checkItemsArray();
    }

    /**
     * Checks that the items array exists and is well formed.
     * That means that every items should have an array as a value, and that
     * that array must contains a 'rules' key at least.
     *
     * @return void
     *
     * @throws Tombebuddy\Vivaldi\Description\DescriptionException
     */
    protected function checkItemsArray()
    {
        if (! is_array($this->items) || count($this->items) < 1) {
            throw new DescriptionException("The ".static::class." descriptor could not be constructed, description items are missing.");
        }

        foreach ($this->items as $item => $value) {
            if (! is_array($value) || ! array_key_exists('rules', $value) || empty($value['rules'])) {
                throw new DescriptionException("The ".static::class." descriptor could not be constructed, {".$item."} item has missing rules.");
            }
        }
    }

    /**
     * Intercept a static call and consider it to be a query to a description item.
     * Instanciate the descriptor if the static instance does not exists.
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        static::checkStaticInstance();

        return static::$instance->getItem($name);
    }

    /**
     * Check that the static instance exists. If not, instanciate it.
     *
     * @return void
     */
    protected static function checkStaticInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
    }

    /**
     * Return all declared items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Return an item given its name.
     *
     * @param  string  $name
     * @return mixed
     *
     * @throws Tombebuddy\Vivaldi\Description\DescriptionException
     */
    public function getItem($name)
    {
        if (! $this->itemExists($name)) {
            throw new DescriptionException("The {".$name."} item does not exists in the ".static::class." descriptor.");
        }

        return $this->items[$name];
    }

    /**
     * Verify that an item exists.
     *
     * @param  string  $name
     * @return boolean
     */
    public function itemExists($name)
    {
        return array_key_exists($name, $this->items);
    }
}
