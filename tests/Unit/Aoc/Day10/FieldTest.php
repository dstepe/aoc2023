<?php

namespace Tests\Unit\Aoc\Day10;

use App\Aoc\Day10\Field;
use App\Aoc\Day10\Row;
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

    private function makeField(): Field
    {
        $field = new Field();

        foreach ($this->makeRows() as $row) {
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
}
