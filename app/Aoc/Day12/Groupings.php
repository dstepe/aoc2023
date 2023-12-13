<?php

namespace App\Aoc\Day12;

use Illuminate\Support\Collection;

class Groupings
{
    private Collection $groupings;

    public function __construct(Collection $groupings)
    {
        $this->groupings = $groupings;
    }

    public function count(): int
    {
        return $this->groupings->count();
    }

    public function groupLength(int $i): int
    {
        return $this->groupings->get($i);
    }
}
