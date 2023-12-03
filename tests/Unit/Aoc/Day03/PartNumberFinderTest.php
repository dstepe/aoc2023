<?php

namespace Tests\Unit\Aoc\Day03;

use App\Aoc\Day03\PartNumberFinder;
use App\Aoc\Day03\PartNumberGenerator;
use App\Aoc\Day03\Point;
use App\Aoc\Day03\Schematic;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class PartNumberFinderTest extends TestCase
{
    public function testFindsPartNumbersFromCandidates(): void
    {
        $finder = new PartNumberFinder($this->prepareSchematic());

        $partNumbers = $finder->findFromCandidates($this->makeCandidates());

        $this->assertCount(1, $partNumbers);
    }

    private function prepareSchematic(): Schematic
    {
        $schematic = new Schematic($this->getInput());

        $schematic->process();

        return $schematic;
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '467..114..',
            '...*......',
        ]);
    }

    private function makeCandidates(): Collection
    {
        $generator = new PartNumberGenerator();

        /** @var Point $point */
        foreach ($this->points() as $point) {
            $generator->processPoint($point);
        }

        return $generator->partNumbers();
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
