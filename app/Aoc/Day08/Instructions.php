<?php

namespace App\Aoc\Day08;

use Illuminate\Support\Collection;

class Instructions
{
    private Collection $instructions;

    public static function fromInput(string $input): self
    {
        return new self(new Collection(str_split($input)));
    }

    public function __construct(Collection $instructions)
    {
        $this->instructions = $instructions;
    }

    public function steps(): \Iterator
    {
        $steps = new Collection($this->instructions);

        while (true) {
            yield $steps->shift();

            if ($steps->isEmpty()) {
                $steps = new Collection($this->instructions);
            }
        }
    }
}
