<?php

namespace App\Aoc\Day16;

class Grid
{
    private \Iterator $input;

    private Positions $positions;
    private Beams $beams;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->positions = new Positions();
        $this->beams = new Beams($this->positions);
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->positions->addFromRowInput($input);
        }

        $this->initializeBeams();

        while ($this->beams->hasOpenBeams()) {
            $this->beams->advance();
        }
    }

    public function energizedCount(): int
    {
        return $this->positions->energizedCount();
    }

    public function printEnergized(): string
    {
        return $this->positions->printEnergized();
    }

    private function initializeBeams(): void
    {
        $this->beams->addFromPosition($this->positions->getPosition(0, 0), Direction::Right);
    }
}
