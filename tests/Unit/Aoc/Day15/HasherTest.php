<?php

namespace Tests\Unit\Aoc\Day15;

use App\Aoc\Day15\Hasher;
use PHPUnit\Framework\TestCase;

class HasherTest extends TestCase
{
    public function testGeneratesHashFromValue(): void
    {
        $hasher = new Hasher();

        $this->assertEquals(52, $hasher->hash('HASH'));
    }
}
