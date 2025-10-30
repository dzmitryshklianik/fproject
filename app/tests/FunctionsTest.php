<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


final class FunctionsTest extends TestCase
{
    public function testAddTwoPositiveIntegers(): void
    {
        $this->assertSame(5, addIntegers(2, 3));
    }

    public function testAddTwoNegativeIntegers(): void
    {
        $this->assertSame(-5, addIntegers(-2,-3));
    }
}