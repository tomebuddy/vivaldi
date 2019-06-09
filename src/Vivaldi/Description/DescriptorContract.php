<?php

namespace Tomebuddy\Vivaldi\Description;

interface DescriptorContract
{
    /**
     * Retrieve all items
     *
     * @return array
     */
    public function getItems();

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
