<?php

namespace App\Aoc\Day15;

use Illuminate\Support\Collection;

class Processor
{
    private \Iterator $sequence;

    private Hasher $hasher;
    private Collection $stepValues;

    public function __construct(\Iterator $sequence)
    {
        $this->sequence = $sequence;

        $this->hasher = new Hasher();
        $this->stepValues = new Collection();
    }

    public function generateHash(): int
    {
        foreach ($this->sequence as $step) {
            $this->stepValues->add($this->hasher->hash($step));
        }

        return $this->stepValues->sum();
    }
}
