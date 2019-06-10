<?php

namespace Tomebuddy\Vivaldi\Description;

use Exception;

class DescriptionException extends Exception {

    /**
     * Constructor
     *
     * @param  string $message
     * @return void
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
