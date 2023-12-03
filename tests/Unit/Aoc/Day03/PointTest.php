<?php

namespace Tests\Unit\Aoc\Day03;

use App\Aoc\Day03\Point;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    #[DataProvider('symbolChecks')]
    public function testAssertsTypes(string $value, bool $isEmpty, bool $isNumeric, bool $isSymbol): void
    {
        $point = new Point($value, 1, 1);

        $this->assertEquals($isEmpty, $point->isEmpty());
        $this->assertEquals($isNumeric, $point->isNumeric());
        $this->assertEquals($isSymbol, $point->isSymbol());
    }

    public static function symbolChecks(): array
    {
        return [
            'is empty' => ['.', true, false, false],
            'is numeric' => ['1', false, true, false],
            'is symbol $' => ['$', false, false, true],
        ];
    }

    #[DataProvider('isAdjacentChecks')]
    public function testIsAdjacentToPoint(Point $candidate, bool $expected): void
    {
        $point = new Point(1, 1, 1);

        $this->assertEquals($expected, $point->isNeighbor($candidate));
    }

    public static function isAdjacentChecks(): array
    {
        return [
            'top left' => [new Point('*', 0, 0), true],
            'top center' => [new Point('*', 0, 1), true],
            'top right' => [new Point('*', 0, 2), true],
            'left' => [new Point('*', 1, 0), true],
            'right' => [new Point('*', 1, 2), true],
            'bottom left' => [new Point('*', 2, 0), true],
            'bottom center' => [new Point('*', 2, 1), true],
            'bottom right' => [new Point('*', 2, 2), true],
            'not adjacent' => [new Point('*', 4, 0), false],
        ];
    }
}
