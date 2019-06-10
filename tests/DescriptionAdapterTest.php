<?php

namespace Tomebuddy\Vivaldi\Tests;

use PHPUnit\Framework\TestCase;
use Tomebuddy\Vivaldi\Validation\DescriptionAdapter;
use Tomebuddy\Vivaldi\Validation\AdaptationException;

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
}
