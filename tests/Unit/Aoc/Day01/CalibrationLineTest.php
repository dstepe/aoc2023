<?php

namespace Tests\Unit\Aoc\Day01;

use App\Aoc\Day01\CalibrationLine;
use PHPUnit\Framework\TestCase;

class CalibrationLineTest extends TestCase
{
    /**
     * @dataProvider calibrationLineChecks
     */
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
}
