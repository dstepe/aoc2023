<?php

namespace App\Aoc\Day11;

class ImageProcessor
{
    private \Iterator $input;

    private Image $image;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->image = new Image();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->image->addRowFromInput($input);
        }

        $this->image->expand();
    }

    public function totalDistance(): int
    {
        return $this->image->totalGalaxyDistances();
    }
}
