<?php

namespace Tests\Unit\Aoc\Day05;

use App\Aoc\Day05\Map;
use App\Aoc\Day05\MapEntry;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    #[DataProvider('mapSourceChecks')]
    public function testMapsSourceToDestination(int $source, int $destination): void
    {
        $map = new Map();

        $map->add(new MapEntry(50, 98, 2));
        $map->add(new MapEntry(52, 50, 48));

        $this->assertEquals($destination, $map->findDestination($source));
    }

    public static function mapSourceChecks(): array
    {
        return [
            [79, 81],
            [14, 14],
            [55, 57],
            [13, 13],
        ];
    }
}
