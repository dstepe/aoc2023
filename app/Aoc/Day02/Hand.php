<?php

namespace App\Aoc\Day02;

class Hand
{
    private string $input;

    private int $red = 0;
    private int $green = 0;
    private int $blue = 0;

    public static function fromInput(string $input): self
    {
        return new self($input);
    }

    public function __construct(string $input)
    {
        $this->input = $input;

        $this->parseInput();
    }

    public function red(): int
    {
        return $this->red;
    }

    public function green(): int
    {
        return $this->green;
    }

    public function blue(): int
    {
        return $this->blue;
    }

    private function parseInput(): void
    {
        $this->red = $this->findCount('red');
        $this->green = $this->findCount('green');
        $this->blue = $this->findCount('blue');
    }

    private function findCount(string $color): int
    {
        if (preg_match("/(\d+) $color/", $this->input, $matches)) {
            return $matches[1];
        }

        return 0;
    }
}
