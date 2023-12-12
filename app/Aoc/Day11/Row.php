<?php

namespace App\Aoc\Day11;

use Illuminate\Support\Collection;

class Row extends Collection
{
    public function print(): string
    {
        return $this->reduce(function (Collection $c, Position $position) {
            $c->add($position->label());
            return $c;
        }, new Collection())->join('');
    }

    public function hasGalaxy(): bool
    {
        return $this->filter(function (Position $postion) {
            return $postion->isGalaxy();
        })->isNotEmpty();
    }

    public function hasNoGalaxy(): bool
    {
        return !$this->hasGalaxy();
    }
}
