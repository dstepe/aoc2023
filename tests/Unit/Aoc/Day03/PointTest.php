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
}
