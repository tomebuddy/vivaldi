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
     * @throws \Tomebuddy\Vivaldi\Validation\AdaptationException
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
     * @param  string|\Tomebuddy\Vivaldi\Description\DescriptorContract  $descriptor
     * @param  string  $item
     * @return \Tomebuddy\Vivaldi\Validation\DescriptionAdapter
     *
     * @throws \Tomebuddy\Vivaldi\Validation\AdaptationException
     */
    public function using($descriptor, string $item)
    {
        // If the descriptor is not an instanciated descriptor, consider it to
        // be a descriptor class that must be instanciated
        if(is_string($descriptor)) {
            $descriptor = new $descriptor();
        }

        if(! is_a($descriptor, DescriptorContract::class)) {
            throw new AdaptationException('The descriptor passed as an argument does not implement the DescriptorContract interface.');
        }

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
