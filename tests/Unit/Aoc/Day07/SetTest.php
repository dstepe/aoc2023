<?php

namespace Tests\Unit\Aoc\Day07;

use App\Aoc\Day07\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testFindsTotalWinnings(): void
    {
        $set = new Set($this->getInput());

        $set->process();

        $this->assertEquals(6440, $set->winnings());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '32T3K 765',
            'T55J5 684',
            'KK677 28',
            'KTJJT 220',
            'QQQJA 483',
        ]);
    }
}
