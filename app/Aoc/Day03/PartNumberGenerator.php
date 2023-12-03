<?php

namespace App\Aoc\Day03;

use Illuminate\Support\Collection;

class PartNumberGenerator
{
    private Collection $partNumbers;
    
    private ?Collection $current = null;

    public function __construct()
    {
        $this->partNumbers = new Collection();
    }
    
    public function processPoint(Point $point): void
    {
        if ($point->isNumeric()) {
           $this->addToCurrent($point);
        }

        if ($point->isNotNumeric()) {
            $this->endCurrent();
        }
    }

    public function partNumbers(): Collection
    {
        return $this->partNumbers->map(function (Collection $points) {
            return new PartNumber($points);
        });
    }

    private function addToCurrent(Point $point): void
    {
        if (null === $this->current) {
            $this->current = new Collection();
            $this->partNumbers->add($this->current);
        }

        $this->current->add($point);
    }

    private function endCurrent(): void
    {
        $this->current = null;
    }
}
