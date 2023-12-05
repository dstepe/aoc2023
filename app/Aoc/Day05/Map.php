<?php

namespace App\Aoc\Day05;

use Illuminate\Support\Collection;

class Map extends Collection
{
    public function findDestination(int $source): int
    {
        /** @var MapEntry $entry */
        $entry = $this->first(function (MapEntry $entry) use ($source) {
            return $entry->containsSource($source);
        });

        if (empty($entry)) {
            return $source;
        }

        return $entry->mapSource($source);
    }
}
