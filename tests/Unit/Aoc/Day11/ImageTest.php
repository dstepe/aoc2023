<?php

namespace Tests\Unit\Aoc\Day11;

use App\Aoc\Day11\Image;
use App\Aoc\Day11\Position;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testParsesInputData(): void
    {
        $image = new Image();

        foreach ($this->originalInput() as $input) {
            $image->addRowFromInput($input);
        }

        $this->assertEquals(implode("\n", $this->originalInput()), $image->print());
    }

    public function testExpandsImage(): void
    {
        $image = new Image();

        foreach ($this->originalInput() as $input) {
            $image->addRowFromInput($input);
        }

        $image->expand();

        $this->assertEquals(implode("\n", $this->expandedInput()), $image->print());
    }

    public function testFindsGalaxiesPairs(): void
    {
        $image = new Image();

        foreach ($this->originalInput() as $input) {
            $image->addRowFromInput($input);
        }

        $image->expand();

        $this->assertCount(36, $image->galaxyPairs());
    }

    #[DataProvider('distanceChecks')]
    public function testFindsDistanceBetweenGalaxies(Position $a, Position $b, int $expected): void
    {
        $image = new Image();

        foreach ($this->originalInput() as $input) {
            $image->addRowFromInput($input);
        }

        $image->expand();

        $this->assertEquals($expected, $image->distanceBetween($a, $b));
    }

    public static function distanceChecks(): array
    {
        return [
            '5 and 9' => [new Position('#', 6, 1), new Position('#', 11, 5), 9],
            '1 and 7' => [new Position('#', 0, 4), new Position('#', 10, 9), 15],
            '3 and 6' => [new Position('#', 2, 0), new Position('#', 7, 12), 17],
            '8 and 9' => [new Position('#', 11, 0), new Position('#', 11, 5), 5],
        ];
    }

    public function testFindsAllGalaxyDistances(): void
    {
        $image = new Image();

        foreach ($this->originalInput() as $input) {
            $image->addRowFromInput($input);
        }

        $image->expand();

        $this->assertEquals(374, $image->totalGalaxyDistances());
    }

    private function originalInput(): array
    {
        return [
            '...#......',
            '.......#..',
            '#.........',
            '..........',
            '......#...',
            '.#........',
            '.........#',
            '..........',
            '.......#..',
            '#...#.....',
        ];
    }

    private function expandedInput(): array
    {
        return [
            '....#........',
            '.........#...',
            '#............',
            '.............',
            '.............',
            '........#....',
            '.#...........',
            '............#',
            '.............',
            '.............',
            '.........#...',
            '#....#.......',
        ];
    }
}
