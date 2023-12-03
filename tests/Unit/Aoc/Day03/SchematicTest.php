<?php

namespace Tests\Unit\Aoc\Day03;

use App\Aoc\Day03\Point;
use App\Aoc\Day03\Schematic;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SchematicTest extends TestCase
{
    #[DataProvider('adjacentChecks')]
    public function testDeterminesIfPointIsAdjacentToSymbol(Point $point, bool $expected): void
    {
        $schematic = new Schematic($this->getInput());

        $schematic->process();

        $this->assertEquals($expected, $schematic->pointAdjacentToSymbol($point));
    }

    public static function adjacentChecks(): array
    {
        return [
            'adjacent' => [new Point(7, 0, 2), true],
            'not adjacent' => [new Point(4, 0, 7), false],
        ];
    }

    public function testGetsPartNumbersFromInput(): void
    {
        $schematic = new Schematic($this->getInput());

        $schematic->process();

        $this->assertEquals(4361, $schematic->total());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
           '467..114..',
           '...*......',
           '..35..633.',
           '......#...',
           '617*......',
           '.....+.58.',
           '..592.....',
           '......755.',
           '...$.*....',
           '.664.598..',
        ]);
    }
}
