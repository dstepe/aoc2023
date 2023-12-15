<?php

namespace Tests\Unit\Aoc\Day13;

use App\Aoc\Day13\Location;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    #[DataProvider('valueChecks')]
    public function testDeterminesValueForLocation(Location $location, int $expected): void
    {
        $this->assertEquals($expected, $location->value());
    }

    public static function valueChecks(): array
    {
        return [
            [new Location('c', 4), 5],
            [new Location('r', 3), 400]
        ];
    }
}
