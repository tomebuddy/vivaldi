<?php

namespace Tomebuddy\Vivaldi\Description;

use Exception;

class ItemsMissingException extends Exception {

    /**
     * Constructor
     *
     * @param  string $descriptor
     * @return void
     */
    public function __construct(string $descriptor)
    {
        parent::__construct("The $descriptor descriptor could not be constructed, description items are missing.");
    }
}
