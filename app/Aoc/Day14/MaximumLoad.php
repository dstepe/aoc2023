<?php

namespace App\Aoc\Day14;

class MaximumLoad
{
    private static int $limit = 0;

    public static function increment(): void
    {
        self::$limit++;
    }

    public static function limit(): int
    {
        return self::$limit;
    }
}
