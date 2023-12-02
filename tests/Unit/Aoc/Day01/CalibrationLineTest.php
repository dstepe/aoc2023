<?php

namespace Tests\Unit\Aoc\Day01;

use App\Aoc\Day01\CalibrationLine;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalibrationLineTest extends TestCase
{
    #[DataProvider('calibrationLineChecks')]
    public function testGetsDigitsFromLine(string $line, int $expected): void
    {
        $line = new CalibrationLine($line);

        $this->assertEquals($expected, $line->digits());
    }

    public static function calibrationLineChecks(): array
    {
        return [
            ['1abc2', 12],
            ['pqr3stu8vwx', 38],
            ['a1b2c3d4e5f', 15],
            ['treb7uchet', 77],
        ];
    }

    #[DataProvider('calibrationLineSpelledOutChecks')]
    public function testGetsDigitsFromSpelledOutLine(string $line, int $expected): void
    {
        $line = new CalibrationLine($line);

        $this->assertEquals($expected, $line->digits());
    }

    public static function calibrationLineSpelledOutChecks(): array
    {
        return [
            ['two1nine', 29],
            ['eightwothree', 83],
            ['abcone2threexyz', 13],
            ['xtwone3four', 24],
            ['4nineeightseven2', 42],
            ['zoneight234', 14],
            ['7pqrstsixteen', 76],
        ];
    }
}
