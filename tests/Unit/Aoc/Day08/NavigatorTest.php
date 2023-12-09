<?php

namespace Tests\Unit\Aoc\Day08;

use App\Aoc\Day08\Navigator;
use PHPUnit\Framework\TestCase;

class NavigatorTest extends TestCase
{
    public function testCreatesNodesFromInput(): void
    {
        $navigator = new Navigator($this->getInput());

        $navigator->process();

        $this->assertCount(3, $navigator->nodes());
    }

    public function testFindsStepsThroughNodes(): void
    {
        $navigator = new Navigator($this->getInput());

        $navigator->process();

        $this->assertEquals(6, $navigator->steps());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            'LLR',
            '',
            'AAA = (BBB, BBB)',
            'BBB = (AAA, ZZZ)',
            'ZZZ = (ZZZ, ZZZ)',
        ]);
    }
}
