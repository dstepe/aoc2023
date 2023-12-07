<?php

namespace Tests\Unit\Aoc\Day06;

use App\Aoc\Day06\Race;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public function testFindsOutperformingOptions()
    {
        $race = new Race(7, 9);

        $this->assertCount(4, $race->outperformingOptions());
    }
}
