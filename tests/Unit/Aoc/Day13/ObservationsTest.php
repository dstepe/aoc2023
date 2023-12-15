<?php

namespace Tests\Unit\Aoc\Day13;

use App\Aoc\Day13\Observations;
use PHPUnit\Framework\TestCase;

class ObservationsTest extends TestCase
{
    public function testFindsTotalValueOfPatterns(): void
    {
        $observations = new Observations($this->getInput());

        $observations->process();

        $this->assertEquals(405, $observations->totalValue());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '#.##..##.',
            '..#.##.#.',
            '##......#',
            '##......#',
            '..#.##.#.',
            '..##..##.',
            '#.#.##.#.',
            '',
            '#...##..#',
            '#....#..#',
            '..##..###',
            '#####.##.',
            '#####.##.',
            '..##..###',
            '#....#..#',
        ]);
    }
}
