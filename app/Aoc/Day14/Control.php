<?php

namespace App\Aoc\Day14;

class Control
{
    private \Iterator $input;
    private Platform $platform;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;
    }

    public function process(): void
    {
        $factory = new Factory();
        foreach ($this->input as $input) {
            $factory->addRowFromInput($input);
        }

        $this->platform = $factory->make();
    }

    public function totalLoad(): int
    {
        $this->platform->tilt();
        
        return $this->platform->totalLoad();
    }
}
