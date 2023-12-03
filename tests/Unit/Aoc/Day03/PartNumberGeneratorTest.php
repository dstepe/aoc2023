<?php

namespace Tests\Unit\Aoc\Day03;

use App\Aoc\Day03\PartNumberGenerator;
use App\Aoc\Day03\Point;
use PHPUnit\Framework\TestCase;

class PartNumberGeneratorTest extends TestCase
{
    public function testGetsPartNumbersFromInput(): void
    {
        $generator = new PartNumberGenerator();

        /** @var Point $point */
        foreach ($this->points() as $point) {
            $generator->processPoint($point);
        }

        $partNumbers = $generator->partNumbers();

        $this->assertCount(2, $partNumbers);
        $this->assertEquals(467, $partNumbers[0]->value());
        $this->assertEquals(114, $partNumbers[1]->value());
    }

    private function points(): \Iterator
    {
        $line = '467..114..';

        $columnNumber = 0;
        foreach (str_split($line) as $datum) {
            yield new Point($datum, 0, $columnNumber);
            $columnNumber++;
        }
    }
}
