<?php

namespace Tests\Unit\Aoc\Day12;

use App\Aoc\Day12\Report;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function testFindsTotalArrangements(): void
    {
        $report = new Report($this->getInput());

        $report->process();

        $this->assertEquals(21, $report->totalArrangements());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '???.### 1,1,3',
            '.??..??...?##. 1,1,3',
            '?#?#?#?#?#?#?#? 1,3,1,6',
            '????.#...#... 4,1,1',
            '????.######..#####. 1,6,5',
            '?###???????? 3,2,1',

        ]);
    }
}
