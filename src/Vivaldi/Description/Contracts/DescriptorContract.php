<?php

namespace Tomebuddy\Vivaldi\Description\Contracts;

interface DescriptorContract
{
    /**
     * Retrieve all items
     *
     * @return array
     */
    public function getItems();

    /**
     * Retrieve all items' names
     *
     * @return array
     */
    public function getItemsNames();

    /**
     * Retrieve an item
     *
     * @return array
     */
    public function getItem($name);

    /**
     * Check that an item exists
     *
     * @return array
     */
    public function itemExists($name);
}
