<?php

namespace Tests\Unit\Aoc\Day09;

use App\Aoc\Day09\Predictor;
use PHPUnit\Framework\TestCase;

class PredictorTest extends TestCase
{
    public function testFindsSumOfValues(): void
    {
        $predictor = new Predictor($this->getInput());

        $predictor->process();

        $this->assertEquals(114, $predictor->sum());
    }

    private function getInput(): \Iterator
    {
        return new \ArrayIterator([
            '0 3 6 9 12 15',
            '1 3 6 10 15 21',
            '10 13 16 21 30 45',
        ]);
    }
}
