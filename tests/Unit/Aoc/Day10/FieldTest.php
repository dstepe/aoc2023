<?php

namespace Tests\Unit\Aoc\Day10;

use App\Aoc\Day10\Field;
use App\Aoc\Day10\Row;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public function testFindsStartPosition(): void
    {
        $field = $this->makeField();

        $start = $field->startPosition();

        $this->assertEquals('1:1', $start->coordinates());
    }

    public function testFindsFarthestPosition(): void
    {
        $field = $this->makeField();

        $this->assertEquals(4, $field->farthestDistance());
    }

    private function makeField(array $input = null): Field
    {
        if (null === $input) {
            $input = $this->makeRows();
        }

        $field = new Field();

        foreach ($input as $row) {
            $field->addRowFromInput($row);
        }

        return $field;
    }

    private function makeRows(): array
    {
        return [
            '-L|F7',
            '7S-7|',
            'L|7||',
            '-L-J|',
            'L|-JF',
        ];
    }

    #[DataProvider('containedPositionChecks')]
    public function testFindsContainedPositionCount(array $input, int $expected): void
    {
        $field = $this->makeField($input);

        $contained = $field->containedPositionsCount();

        print $field->printFieldContained();

        $this->assertEquals($expected, $contained);
    }

    public static function containedPositionChecks(): array
    {
        return [
            'simple' => [self::simpleField(), 4],
        ];
    }

    private static function simpleField(): array
    {
        return [
            '...........',
            '.S-------7.',
            '.|F-----7|.',
            '.||.....||.',
            '.||.....||.',
            '.|L-7.F-J|.',
            '.|..|.|..|.',
            '.L--J.L--J.',
            '...........',
        ];
    }
}
