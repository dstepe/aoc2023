<?php

namespace App\Aoc\Day14;

use Illuminate\Support\Collection;

class Positions extends Collection
{
    public function columns(): Collection
    {
        return $this->groupBy(function (Position $position) {
            return $position->column();
        });
    }

    public function rows(): Collection
    {
        return $this->groupBy(function (Position $position) {
            return $position->row();
        });
    }

    public function load(): int
    {
        return $this->filter(function (Position $position) {
            return $position->isRounded();
        })->sum(function (Position $position) {
            return $position->load();
        });
    }
}
