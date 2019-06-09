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
    protected $items = [];

    /**
     * Constructor
     *
     * @param  array $items
     * @return void
     *
     * @throws Tombebuddy\Vivaldi\Description\ItemsMissingException
     */
    public function __construct($items = [])
    {
        if (! is_array($items) || count($items) < 1) {
            throw new ItemsMissingException(static::class);
        }

        $this->items = $items;
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
}
