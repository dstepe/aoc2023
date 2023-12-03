<?php

namespace App\Aoc\Day03;

use Illuminate\Support\Collection;

class Row
{
    private int $number;
    private Collection $points;

    public function __construct(int $number)
    {
        $this->number = $number;

        $this->points = new Collection();
    }

    public function addPoint(Point $point): void
    {
        if ($this->number !== $point->row()) {
            throw new \InvalidArgumentException('Invalid row number for point');
        }

        $this->points->add($point);
    }

    public function get(int $index): Point
    {
        return $this->points->get($index);
    }

    public function count(): int
    {
        return $this->points->count();
    }

    public function gearPoints(): Collection
    {
        return $this->points->filter(function (Point $point) {
            return $point->isGear();
        });
    }
}
