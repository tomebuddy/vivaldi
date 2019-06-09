<?php

namespace Vivaldi\Tests;

use PHPUnit\Framework\TestCase;
use Tomebuddy\Vivaldi\Description\Descriptor;
use Tomebuddy\Vivaldi\Description\ItemsMissingException;

class DescriptorTest extends TestCase
{
    public function testCanBeInstanciatedWithAnArray()
    {
        $descriptor = new Descriptor(['item' => null]);
        $this->assertInstanceOf(Descriptor::class, $descriptor);
    }

    public function testCannotBeInstanciatedWithoutAnArray()
    {
        $this->expectException(ItemsMissingException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Description\Descriptor descriptor could not be constructed, description items are missing.');
        new Descriptor();
    }

    public function testCannotBeInstanciatedWithAnEmptyArray()
    {
        $this->expectException(ItemsMissingException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Description\Descriptor descriptor could not be constructed, description items are missing.');
        new Descriptor([]);
    }

    public function testCanReturnAllItems()
    {
        $array = ['item' => null];
        $descriptor = new Descriptor($array);
        $items = $descriptor->getItems();

        $this->assertIsArray($items);
        $this->assertEquals($items, $array);
    }
}
