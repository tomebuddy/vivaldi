<?php

namespace Tomebuddy\Vivaldi\Validation;

use Tomebuddy\Vivaldi\Validation\AdaptationException;

class DescriptionAdapter
{
    /*
    |--------------------------------------------------------------------------
    | Descriptor Adapter
    |--------------------------------------------------------------------------
    | The purpose of this class is to adapt a description item to a validator.
    | Allowing to change or add validation rules, messages or attributes to the
    | description item.
    |
    */

    /**
     * The input's name that must be validated.
     *
     * @var string
     */
    protected $input;

    /**
     * The validation rules array
     *
     * @var array
     */
    protected $rules = [];

    /**
     * The validation messages array
     *
     * @var array
     */
    protected $messages = [];

    /**
     * The custom attributes array
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Construct a DescriptionAdapter by providing the input.
     *
     * @param  string  $input
     * @return void
     *
     * @throws
     */
    public function __construct(string $input)
    {
        if (empty($input = trim($input))) {
            throw new AdaptationException('The '.static::class.' could not be constructed, input is missing.');
        }

        $this->input = $input;
    }
}
