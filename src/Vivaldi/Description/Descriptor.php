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

        if (! is_array($this->items) || count($this->items) < 1) {
            throw new DescriptionException("The ".static::class." descriptor could not be constructed, description items are missing.");
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
     */
    public function getItem($name)
    {
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
