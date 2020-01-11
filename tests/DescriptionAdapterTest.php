<?php

namespace Tomebuddy\Vivaldi\Tests;

use PHPUnit\Framework\TestCase;
use Tomebuddy\Vivaldi\Validation\DescriptionAdapter;
use Tomebuddy\Vivaldi\Validation\AdaptationException;
use Tomebuddy\Vivaldi\Tests\Samples\DescriptorSample;

class DescriptionAdapterTest extends TestCase
{
    public function testCanBeInstanciatedWithAnInput()
    {
        $adapter = new DescriptionAdapter('input');
        $this->assertInstanceOf(DescriptionAdapter::class, $adapter);
    }

    public function testCannotBeInstanciatedWithoutAnInput()
    {
        $this->expectException(\ArgumentCountError::class);
        new DescriptionAdapter();
    }

    public function testCannotBeInstanciatedWithAnEmptyInput()
    {
        $this->expectException(AdaptationException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Validation\DescriptionAdapter could not be constructed, input is missing.');
        new DescriptionAdapter('');
    }

    public function testCannotBeInstanciatedWithAWhitespaceInput()
    {
        $this->expectException(AdaptationException::class);
        $this->expectExceptionMessage('The Tomebuddy\Vivaldi\Validation\DescriptionAdapter could not be constructed, input is missing.');
        new DescriptionAdapter('  ');
    }

    public function testCanReturnTheDeclaredInput()
    {
        $adapter = new DescriptionAdapter('input');
        $this->assertEquals($adapter->getInput(), 'input');
    }

    public function testCanUseADescriptionItem()
    {
        $descriptor = new DescriptorSample();
        $adapter = new DescriptionAdapter('input');
        $adapter->using($descriptor, 'item1');
        $this->assertInstanceOf(DescriptionAdapter::class, $adapter);
    }

    public function testCanUseADescriptionItemRules()
    {
        $descriptor = new DescriptorSample();
        $adapter = new DescriptionAdapter('input');
        $adapter->using($descriptor, 'item1');
        $this->assertEquals($adapter->getRules(), 'test1');
    }

    public function testCanUseADescriptionItemMessages()
    {
        $descriptor = new DescriptorSample();
        $adapter = new DescriptionAdapter('input');
        $adapter->using($descriptor, 'item1');
        $this->assertEquals($adapter->getMessages(), 'message1');
    }

    public function testCanUseADescriptionItemRulesAndMessagesFromClass()
    {
        $adapter = new DescriptionAdapter('input');
        $adapter->using(DescriptorSample::class, 'item1');

        $this->assertInstanceOf(DescriptionAdapter::class, $adapter);
        $this->assertEquals($adapter->getRules(), 'test1');
        $this->assertEquals($adapter->getMessages(), 'message1');
    }

    public function testCannotUseANonDescriptorClass()
    {
        $this->expectException(AdaptationException::class);
        $this->expectExceptionMessage('The descriptor passed as an argument does not implement the DescriptorContract interface.');

        $adapter = new DescriptionAdapter('input');
        $adapter->using(static::class, 'item1');
    }
}
