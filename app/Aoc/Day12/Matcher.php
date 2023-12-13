<?php

namespace App\Aoc\Day12;

class Matcher
{
    private Groupings $groupings;

    public function __construct(Groupings $groupings)
    {
        $this->groupings = $groupings;
    }

    public function matches(string $candidate): bool
    {
        if (!preg_match_all('/(#+)/', $candidate, $matches)) {
            return false;
        }

        if (count($matches[1]) !== $this->groupings->count()) {
            return false;
        }

        for ($i = 0, $iMax = count($matches[1]); $i < $iMax; $i++) {
            if (strlen($matches[1][$i]) !== $this->groupings->groupLength($i)) {
                return false;
            }
        }

        return true;
    }
}
