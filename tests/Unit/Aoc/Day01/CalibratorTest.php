<?php

namespace Tests\Unit\Aoc\Day01;

use App\Aoc\Day01\Calibrator;
use PHPUnit\Framework\TestCase;

class CalibratorTest extends TestCase
{
    public function testGetsTotalOfDigits(): void
    {
        $calibrator = new Calibrator($this->getInput());

        $calibrator->calibrate();

        $this->assertEquals(142, $calibrator->total());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '1abc2',
            'pqr3stu8vwx',
            'a1b2c3d4e5f',
            'treb7uchet',
        ]);
    }

    public function testGetsTotalOfDigitsWithSpellings(): void
    {
        $calibrator = new Calibrator($this->getInputWithSpellings());

        $calibrator->calibrate();

        $this->assertEquals(281, $calibrator->total());
    }

    private function getInputWithSpellings(): \Iterator
    {
        return new \ArrayIterator([
            'two1nine',
            'eightwothree',
            'abcone2threexyz',
            'xtwone3four',
            '4nineeightseven2',
            'zoneight234',
            '7pqrstsixteen',
        ]);
    }
}
