<?php

namespace App\Aoc\Day01;

use Illuminate\Support\Collection;

class Calibrator
{
    private \Iterator $input;

    /** @var Collection */
    private $lines;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->lines = new Collection();
    }

    public function calibrate(): void
    {
        foreach ($this->input as $input) {
            $this->lines->add(new CalibrationLine($input));
        }
    }

    public function total(): int
    {
        return $this->lines->reduce(function (int $total, CalibrationLine $line) {
            $total += $line->digits();
            return $total;
        }, 0);
    }
}
