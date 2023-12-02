<?php

namespace Tests\Unit\Aoc\Day02;

use App\Aoc\Day02\Hand;
use PHPUnit\Framework\TestCase;

class HandTest extends TestCase
{
    public function testMakesHandFromInput(): void
    {
        $hand = Hand::fromInput('1 red, 2 green, 6 blue');

        $this->assertEquals(1, $hand->red());
        $this->assertEquals(2, $hand->green());
        $this->assertEquals(6, $hand->blue());
    }

    public function testMakesHandFromInputMissingColor(): void
    {
        $hand = Hand::fromInput('1 red, 6 blue');

        $this->assertEquals(1, $hand->red());
        $this->assertEquals(0, $hand->green());
        $this->assertEquals(6, $hand->blue());
    }
}
