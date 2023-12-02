<?php

namespace Tests\Unit\Aoc\Day02;

use App\Aoc\Day02\CubeSet;
use PHPUnit\Framework\TestCase;

class CubeSetTest extends TestCase
{
    public function testCalculatesPower(): void
    {
        $cubeSet = new CubeSet(4, 2, 6);

        $this->assertEquals(48, $cubeSet->power());
    }
}
