<?php

namespace Tests\Unit\Aoc\Day10;

use App\Aoc\Day10\Type;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    #[DataProvider('isPipeChecks')]
    public function testAssertsIsPipe(string $label, bool $expected): void
    {
        $type = new Type($label);

        $this->assertEquals($expected, $type->isPipe());
        $this->assertEquals(!$expected, $type->isNotPipe());
    }

    public static function isPipeChecks(): array
    {
        return [
            'vertical pipe' => ['|', true],
            'horizontal pipe' => ['-', true],
            '90 north east' => ['L', true],
            '90 north west' => ['J', true],
            '90 south west' => ['7', true],
            '90 south east' => ['F', true],
            'ground' => ['.', false],
            'start' => ['S', true],
        ];
    }
}
