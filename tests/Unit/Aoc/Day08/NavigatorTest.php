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

        $this->assertCount(8, $navigator->nodes());
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
            'LR',
            '',
            '11A = (11B, XXX)',
            '11B = (XXX, 11Z)',
            '11Z = (11B, XXX)',
            '22A = (22B, XXX)',
            '22B = (22C, 22C)',
            '22C = (22Z, 22Z)',
            '22Z = (22B, 22B)',
            'XXX = (XXX, XXX)',
        ]);
    }
}
