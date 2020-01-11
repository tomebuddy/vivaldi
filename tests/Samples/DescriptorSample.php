<?php

namespace Tomebuddy\Vivaldi\Tests\Samples;

use Tomebuddy\Vivaldi\Description\Descriptor;

class DescriptorSample extends Descriptor
{
    protected $items = [
        'item1' => ['rules' => 'test1', 'messages' => 'message1'],
        'item2' => ['rules' => 'test2', 'messages' => 'message2'],
    ];
}
