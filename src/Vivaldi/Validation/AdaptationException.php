<?php

namespace Tomebuddy\Vivaldi\Validation;

use Exception;

class AdaptationException extends Exception {

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
