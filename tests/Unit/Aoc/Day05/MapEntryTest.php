<?php

namespace Tests\Unit\Aoc\Day05;

use App\Aoc\Day05\MapEntry;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MapEntryTest extends TestCase
{
    #[DataProvider('containsChecks')]
    public function testAssertsContainsSource(int $source, bool $expected): void
    {
        $entry = new MapEntry(50, 98, 2);

        $this->assertEquals($expected, $entry->containsSource($source));
    }

    public static function containsChecks(): array
    {
        return [
            [97, false],
            [98, true],
            [99, true],
            [100, false],
        ];
    }

    #[DataProvider('mapsChecks')]
    public function testMapsSourceToDestination(int $source, int $expected): void
    {
        $entry = new MapEntry(50, 98, 2);

        $this->assertEquals($expected, $entry->mapSource($source));
    }

    public static function mapsChecks(): array
    {
        return [
            [98, 50],
            [99, 51],
        ];
    }

    public function testThrowsExceptionMappingSourceOutsideOfRange(): void
    {
        $entry = new MapEntry(50, 98, 2);

        $this->expectException(\InvalidArgumentException::class);

        $entry->mapSource(10);
    }
}
