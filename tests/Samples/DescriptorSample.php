<?php

namespace Tomebuddy\Vivaldi\Tests\Samples;

use Tomebuddy\Vivaldi\Description\Descriptor;

class DescriptorSample extends Descriptor
{
    protected $items = [
        'item1' => ['rules' => 'test', 'messages' => 'message'],
        'item2' => ['rules' => 'test', 'messages' => 'message'],
    ];
}
