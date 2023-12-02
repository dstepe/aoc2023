<?php

namespace App\Aoc\Day02;

class CubeSet
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function power(): int
    {
        return $this->red * $this->green * $this->blue;
    }
}
