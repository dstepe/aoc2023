<?php

namespace App\Aoc\Day15;

use Illuminate\Support\Collection;

class Sequencer
{
    private \Iterator $input;

    private Collection $sequence;
    private Processor $processor;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->sequence = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->sequence->add($input);
        }

        $this->processor = new Processor($this->sequence());
    }

    public function verificationNumber(): int
    {
        return $this->processor->generateHash();
    }

    private function sequence(): \Iterator
    {
        $steps = $this->sequence->reduce(function (Collection $c, string $sequence) {
            $c->push(...explode(',', $sequence));
            return $c;
        }, new Collection());

        foreach ($steps as $step) {
            yield $step;
        }
    }
}
