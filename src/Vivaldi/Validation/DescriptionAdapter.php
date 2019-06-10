<?php

namespace Tomebuddy\Vivaldi\Validation;

use Tomebuddy\Vivaldi\Validation\AdaptationException;
use Tomebuddy\Vivaldi\Description\DescriptorContract;

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

    /**
     * Set the description item that must be used to validate the input.
     *
     * @param  \Tomebuddy\Vivaldi\Description\DescriptorContract  $descriptor
     * @param  string  $item
     * @return \Tomebuddy\Vivaldi\Validation\DescriptionAdapter
     */
    public function using(DescriptorContract $descriptor, string $item)
    {
        $this->rules = $descriptor->getItemRules($item);
        $this->messages = $descriptor->getItemMessages($item);
        // TODO : retrieve the attributes too

        return $this;
    }

    /**
     * Return the input
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Return the rules
     *
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Return the messages
     *
     * @return string
     */
    public function getMessages()
    {
        return $this->messages;
    }
}