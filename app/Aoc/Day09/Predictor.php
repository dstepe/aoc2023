<?php

namespace App\Aoc\Day09;

use Illuminate\Support\Collection;

class Predictor
{
    private \Iterator $input;

    private Collection $readings;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->readings = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->readings->add(ReadingHistory::fromInput($input));
        }
    }

    public function sum(): int
    {
        return $this->readings->sum(function (ReadingHistory $reading) {
            return $reading->nextValue();
        });
    }
}
