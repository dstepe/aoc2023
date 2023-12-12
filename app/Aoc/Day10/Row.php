<?php

namespace App\Aoc\Day10;

use Illuminate\Support\Collection;

class Row extends Collection
{
    public function printContained(): string
    {
        return $this->reduce(function (Collection $c, Position $position) {
            $c->add($position->containedLabel());
            return $c;
        }, new Collection())->join('');
    }
}
