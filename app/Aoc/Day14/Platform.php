<?php

namespace App\Aoc\Day14;

use Illuminate\Support\Collection;

class Platform
{
    private Positions $positions;

    public function __construct(Positions $positions)
    {
        $this->positions = $positions;
    }

    public function tilt(): void
    {
        $this->positions->columns()->each(function (Collection $column) {
            $this->rollDown($column);
        });
    }

    private function rollDown(Collection $column): void
    {
        for ($i = 0; $i < $column->count() - 1; $i++) {
            /** @var Position $lower */
            $lower = $column->get($i);
            /** @var Position $candidate */
            $candidate = $column->get($i + 1);

            while (!empty($lower) && $candidate->canRollTo($lower)) {
                $candidate->moveTo($lower);

                $candidate = $lower;
                $lower = $column->get($lower->row() - 1);
            }
        }
    }

    public function totalLoad(): int
    {
        return $this->positions->load();
    }

    public function print(): string
    {
        return $this->positions->rows()->reduce(function (Collection $c, Collection $row) {
            $c->add($row->reduce(function (Collection $c, Position $position) {
                $c->add($position->label());
                return $c;
            }, new Collection())->join(''));
            return $c;
        }, new Collection())->join("\n");
    }
}
