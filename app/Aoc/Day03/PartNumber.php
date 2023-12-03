<?php

namespace App\Aoc\Day03;

use Illuminate\Support\Collection;

class PartNumber
{
    private Collection $points;

    public function __construct(Collection $points)
    {
        $this->points = $points;
    }

    public function points(): Collection
    {
        return $this->points;
    }

    public function value(): int
    {
        return (int) $this->points->reduce(function (string $c, Point $point) {
            $c .= $point->value();
            return $c;
        }, '');
    }

    public function isAdjacentToPoint(Point $point): bool
    {
        return $this->points->reduce(function (bool $isAdjacent, Point $member) use ($point) {
            if ($member->isNeighbor($point)) {
                $isAdjacent = true;
            }
            return $isAdjacent;
        }, false);
    }
}
