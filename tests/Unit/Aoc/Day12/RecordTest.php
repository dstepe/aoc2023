<?php

namespace Tests\Unit\Aoc\Day12;

use App\Aoc\Day12\Record;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    #[DataProvider('arrangementChecks')]
    public function testFindsPossibleArrangements(string $input, int $expected): void
    {
        $record = Record::fromInput($input);

        $this->assertEquals($expected, $record->arrangements());
    }

    public static function arrangementChecks(): array
    {
        return [
            ['???.### 1,1,3', 1],
            ['.??..??...?##. 1,1,3', 4],
            ['?###???????? 3,2,1', 10],
        ];
    }
}
