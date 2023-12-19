<?php

namespace App\Aoc\Day16;

use Illuminate\Support\Collection;

class Beams
{
    private Positions $positions;

    private Collection $beams;

    public function __construct(Positions $positions)
    {
        $this->positions = $positions;

        $this->beams = new Collection();
    }

    public function addFromPosition(Position $position, Direction $direction): void
    {
        $this->beams->add(new Beam($position, $direction, $this->positions));
    }

    public function hasOpenBeams(): bool
    {
        return $this->beams->filter(function (Beam $beam) {
            return $beam->isOnGrid();
        })->isNotEmpty();
    }

    public function advance(): void
    {
        $new = $this->newBeams();

        $this->beams = $this->beams->filter(function (Beam $beam) {
            return $beam->isOffGrid();
        })->merge($new);
    }

    private function newBeams(): Collection
    {
        return $this->open()->reduce(function (Collection $c, Beam $beam) {
            $c->push(...$beam->advance());
            return $c;
        }, new Collection());
    }

    private function open(): Collection
    {
        return $this->beams->filter(function (Beam $beam) {
            return $beam->isOnGrid();
        });
    }
}
