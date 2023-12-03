<?php

namespace App\Aoc\Day03;

use Illuminate\Support\Collection;

class PartNumberFinder
{
    private Schematic $schematic;

    public function __construct(Schematic $schematic)
    {
        $this->schematic = $schematic;
    }

    public function findFromCandidates(Collection $candidates): Collection
    {
        $partNumbers = new Collection();

        $candidates->each(function (PartNumber $partNumber) use ($partNumbers) {
            $isAdjacent = $partNumber->points()->reduce(function (bool $c, Point $point) {
                if ($this->schematic->pointAdjacentToSymbol($point)) {
                    $c = true;
                }

                return $c;
            }, false);

            if ($isAdjacent) {
                $partNumbers->add($partNumber);
            }
        });

        return $partNumbers;
    }
}
