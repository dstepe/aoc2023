<?php

namespace Tests\Unit\Aoc\Day09;

use App\Aoc\Day09\ReadingHistory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ReadingHistoryTest extends TestCase
{
    #[DataProvider('nextValueChecks')]
    public function testFindsNextValue(string $input, int $expected): void
    {
        $history = ReadingHistory::fromInput($input);

        $this->assertEquals($expected, $history->nextValue());
    }

    public static function nextValueChecks(): array
    {
        return [
//            ['0 3 6 9 12 15', 18],
//            ['-6 -3 0 3 6', 0],
//            ['-6 -3 0 3 6 9 12 15', 18],
//            ['1 3 6 10 15 21', 28],
//            ['10 13 16 21 30 45', 68],
//            ['8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 42 44 46 48', 50],
//            ['0 -4 -10 -18 -28 -40 -54 -70 -88 -108 -130 -154 -180 -208 -238 -270 -304 -340 -378 -418 -460', -504],
//            ['7 15 21 25 27 27 25 21 15 7 -3 -15 -29 -45 -63 -83 -105 -129 -155 -183 -213', -245],
//            ['-7 -13 -20 -17 16 108 297 630 1163 1961 3098 4657 6730 9418 12831 17088 22317 28655 36248 45251 55828', -245],
            ['10 13 16 21 30 45', 5],
        ];
    }
}
