<?php

namespace Tests\Unit\Aoc\Day16;

use App\Aoc\Day16\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testCountsEnergizedTiles(): void
    {
        $grid = new Grid($this->makeInput());

        $grid->process();

        print $grid->printEnergized();

        $this->assertEquals(46, $grid->energizedCount());
    }

    private function makeInput(): \Iterator
    {
        return new \ArrayIterator([
            '.|...\....',
            '|.-.\.....',
            '.....|-...',
            '........|.',
            '..........',
            '.........\\',
            '..../.\\\\..',
            '.-.-/..|..',
            '.|....-|.\\',
            '..//.|....',
        ]);
    }
}
