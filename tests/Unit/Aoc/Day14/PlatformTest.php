<?php

namespace Tests\Unit\Aoc\Day14;

use App\Aoc\Day14\Factory;
use App\Aoc\Day14\Platform;
use PHPUnit\Framework\TestCase;

class PlatformTest extends TestCase
{
    public function testFindsTotalLoad(): void
    {
        $platform = $this->makePlatform();

        $platform->tilt();

        $this->assertEquals(136, $platform->totalLoad());
    }

    private function makePlatform(): Platform
    {
        $factory = new Factory();

        foreach ($this->input() as $input) {
            $factory->addRowFromInput($input);
        }

        return $factory->make();
    }

    private function input(): array
    {
        return [
            'O....#....',
            'O.OO#....#',
            '.....##...',
            'OO.#O....O',
            '.O.....O#.',
            'O.#..O.#.#',
            '..O..#O..O',
            '.......O..',
            '#....###..',
            '#OO..#....',
        ];
    }
}
