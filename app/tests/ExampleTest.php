<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testTwoValuesAreTheSame(): void
    {
        $this->assertSame(1,2);
    }
}
