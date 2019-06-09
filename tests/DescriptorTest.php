<?php

namespace Tomebuddy\Vivaldi\Tests;

use PHPUnit\Framework\TestCase;
use Tomebuddy\Vivaldi\Description\Descriptor;
use Tomebuddy\Vivaldi\Description\DescriptionException;
use Tomebuddy\Vivaldi\Tests\Samples\DescriptorSample;

class DescriptorTest extends TestCase
{
    public function testCanBeInstanciatedWithAnArray()
    {
        $descriptor = new Descriptor(['item' => null]);
        $this->assertInstanceOf(Descriptor::class, $descriptor);
    }

    public function testCannotBeInstanciatedWithoutAnArray()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Description\Descriptor descriptor could not be constructed, description items are missing.');
        new Descriptor();
    }

    public function testCannotBeInstanciatedWithAnEmptyArray()
    {
        $this->expectException(DescriptionException::class);
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

    public function testCanBeInstanciatedWithPredeclaredItems()
    {
        $itemsSample = [
            'item1' => ['rules' => null, 'messages' => null],
            'item2' => ['rules' => null, 'messages' => null],
        ];

        $descriptor = new DescriptorSample();

        $this->assertInstanceOf(Descriptor::class, $descriptor);
        $this->assertEquals($descriptor->getItems(), $itemsSample);
    }

    public function testCanOverridePredeclaredItemsOnInstanciation()
    {
        $newItems = [
            'item3' => 'test',
        ];

        $descriptor = new DescriptorSample($newItems);

        $this->assertInstanceOf(Descriptor::class, $descriptor);
        $this->assertEquals($descriptor->getItems(), $newItems);
    }

    public function testCanReturnAnExistingItem()
    {
        $descriptor = new DescriptorSample(['itemTest' => 'test']);

        $item = $descriptor->getItem('itemTest');

        $this->assertEquals($item, 'test');
    }
}
