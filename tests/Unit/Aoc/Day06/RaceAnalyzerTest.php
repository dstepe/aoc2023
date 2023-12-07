<?php

namespace Tests\Unit\Aoc\Day06;

use App\Aoc\Day06\RaceAnalyzer;
use PHPUnit\Framework\TestCase;

class RaceAnalyzerTest extends TestCase
{
    public function testFindsMarginOfError(): void
    {
        $analyzer = new RaceAnalyzer($this->getInput());

        $analyzer->process();

        $this->assertEquals(288, $analyzer->marginOfError());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            'Time:      7  15   30',
            'Distance:  9  40  200',
        ]);
    }
}
