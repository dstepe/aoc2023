<?php

namespace Tests\Unit\Aoc\Day13;

use App\Aoc\Day13\Pattern;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class PatternTest extends TestCase
{
    public function testFindsColumnReflectionValue(): void
    {
        $pattern = Pattern::fromInput($this->columnPatternInput());

        $this->assertEquals(5, $pattern->reflectionValue());
    }

    private function columnPatternInput(): Collection
    {
        return new Collection([
            '#.##..##.',
            '..#.##.#.',
            '##......#',
            '##......#',
            '..#.##.#.',
            '..##..##.',
            '#.#.##.#.',
        ]);
    }

    public function testFindsRowReflectionPoints(): void
    {
        $pattern = Pattern::fromInput($this->rowPatternInput());

        $this->assertEquals(400, $pattern->reflectionValue());
    }

    private function rowPatternInput(): Collection
    {
        return new Collection([
            '#...##..#',
            '#....#..#',
            '..##..###',
            '#####.##.',
            '#####.##.',
            '..##..###',
            '#....#..#',
        ]);
    }

    public function testFindsExampleReflection(): void
    {
        $pattern = Pattern::fromInput($this->exampleInput());

        $this->assertEquals(508, $pattern->reflectionValue());
    }

    private function exampleInput(): Collection
    {
        return new Collection([
            '#.#####',
            '...#..#',
            '####..#',
            '.#.#..#',
            '#..####',
            '#.#####',
            '#......',
            '#.##..#',
            '#.##..#',
            '#......',
            '#..####',
        ]);
    }
}
