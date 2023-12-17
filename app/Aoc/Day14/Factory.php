<?php

namespace App\Aoc\Day14;

use Illuminate\Support\Collection;

class Factory
{
    private Positions $positions;

    private int $currentRow = 0;

    public function __construct()
    {
        $this->positions = new Positions();
    }

    public function addRowFromInput(string $input): void
    {
        $row = new Collection();

        foreach (str_split($input) as $value) {
            $row->add(new Position($value, $this->currentRow, $row->count()));
        }

        $this->appendRow($row);
    }

    public function make(): Platform
    {
        return new Platform($this->positions);
    }

    private function appendRow(Collection $row): void
    {
        $this->positions->push(...$row->values());

        $this->currentRow++;

        MaximumLoad::increment();
    }
}
