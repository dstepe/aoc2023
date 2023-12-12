<?php

namespace Tests\Unit\Aoc\Day11;

use App\Aoc\Day11\ImageProcessor;
use PHPUnit\Framework\TestCase;

class ImageProcessorTest extends TestCase
{
    public function testCreatesImageFromInput(): void
    {
        $processor = new ImageProcessor($this->getInput());

        $processor->process();

    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
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
        ]);
    }
}
