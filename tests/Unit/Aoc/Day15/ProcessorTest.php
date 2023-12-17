<?php

namespace Tests\Unit\Aoc\Day15;

use App\Aoc\Day15\Processor;
use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    public function testGeneratesHashFromSteps(): void
    {
        $processor = new Processor($this->makeSteps());

        $this->assertEquals(1320, $processor->generateHash());
    }

    private function makeSteps(): \Iterator
    {
        $sequence = 'rn=1,cm-,qp=3,cm=2,qp-,pc=4,ot=9,ab=5,pc-,pc=6,ot=7';

        return new \ArrayIterator(explode(',', $sequence));
    }
}
