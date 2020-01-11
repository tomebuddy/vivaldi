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
        $descriptor = new Descriptor(['item' => ['rules' => 'test']]);
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
        $array = ['item' => ['rules' => 'test']];
        $descriptor = new Descriptor($array);
        $items = $descriptor->getItems();

        $this->assertIsArray($items);
        $this->assertEquals($items, $array);
    }

    public function testCanReturnAllItemsNames()
    {
        $items = [
            'item1' => ['rules' => 'test'],
            'item2' => ['rules' => 'test'],
            'item3' => ['rules' => 'test'],
        ];

        $itemsNames = (new Descriptor($items))->getItemsNames();

        $this->assertEquals($itemsNames, ['item1', 'item2', 'item3']);
    }

    public function testCanBeInstanciatedWithPredeclaredItems()
    {
        $itemsSample = [
            'item1' => ['rules' => 'test1', 'messages' => 'message1'],
            'item2' => ['rules' => 'test2', 'messages' => 'message2'],
        ];

        $descriptor = new DescriptorSample();

        $this->assertInstanceOf(Descriptor::class, $descriptor);
        $this->assertEquals($descriptor->getItems(), $itemsSample);
    }

    public function testCanOverridePredeclaredItemsOnInstanciation()
    {
        $newItems = ['item3' => ['rules' => 'test']];

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

    public function testCanReturnAnExistingItemsRules()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test']]);

        $this->assertEquals($descriptor->getItemRules('itemTest'), 'test');
    }

    public function testCanReturnAnExistingItemsMessages()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test', 'messages' => 'message']]);

        $this->assertEquals($descriptor->getItemMessages('itemTest'), 'message');
    }

    public function testCanReturnAnExistingItemsEmptyMessages()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test']]);

        $this->assertEquals($descriptor->getItemMessages('itemTest'), []);
    }

    public function testCannotReturnAnInexistingItem()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The {noItem} item does not exists in the Tomebuddy\Vivaldi\Description\Descriptor descriptor.');

        (new Descriptor(['itemTest' => ['rules' => 'test']]))->getItem('noItem');
    }

    public function testCannotReturnAnInexistingItemRules()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The {noItem} item does not exists in the Tomebuddy\Vivaldi\Description\Descriptor descriptor.');

        (new Descriptor(['itemTest' => ['rules' => 'test']]))->getItemRules('noItem');
    }

    public function testCanCheckThatAnItemExistsOrNot()
    {
        $descriptor = new Descriptor(['itemTest' => ['rules' => 'test']]);

        $this->assertTrue($descriptor->itemExists('itemTest'));
        $this->assertFalse($descriptor->itemExists('noItem'));
    }

    public function testCanStaticallyRetrieveAnItem()
    {
        $this->assertEquals(DescriptorSample::item1(), ['rules' => 'test1', 'messages' => 'message1']);
    }

    public function testCannotStaticallyRetrieveAnUnexistingItem()
    {
        $this->expectException(DescriptionException::class);
        $this->expectExceptionMessage('The {noItem} item does not exists in the Tomebuddy\Vivaldi\Tests\Samples\DescriptorSample descriptor.');

        DescriptorSample::noItem();
    }
}
