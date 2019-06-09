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
        $descriptor = new Descriptor(['item' => ['rules' => null]]);
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

    public function testCannotBeInstanciatedWithAWrongItemsStructure()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Description\Descriptor descriptor could not be constructed, {badItem} item has missing rules.');
        new Descriptor(['badItem' => null]);
    }

    public function testCanReturnAllItems()
    {
        $array = ['item' => ['rules' => null]];
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
        $newItems = ['item3' => ['rules' => null]];

        $descriptor = new DescriptorSample($newItems);

        $this->assertInstanceOf(Descriptor::class, $descriptor);
        $this->assertEquals($descriptor->getItems(), $newItems);
    }

    public function testCanReturnAnExistingItem()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test']]);

        $item = $descriptor->getItem('itemTest');

        $this->assertEquals($item, ['rules' => 'test']);
    }

    public function testCannotReturnAnInexistingItem()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The {noItem} item does not exists in the Tomebuddy\Vivaldi\Description\Descriptor descriptor.');

        (new Descriptor(['itemTest' => ['rules' => 'test']]))->getItem('noItem');
    }

    public function testCanCheckThatAnItemExistsOrNot()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test']]);

        $this->assertTrue($descriptor->itemExists('itemTest'));
        $this->assertFalse($descriptor->itemExists('noItem'));
    }
}
