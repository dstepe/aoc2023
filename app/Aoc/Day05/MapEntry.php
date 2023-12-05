<?php

namespace App\Aoc\Day05;

class MapEntry
{
    private int $destinationRangeStart;
    private int $sourceRangeStart;
    private int $rangeLength;

    public function __construct(int $destinationRangeStart, int $sourceRangeStart, int $rangeLength)
    {
        $this->destinationRangeStart = $destinationRangeStart;
        $this->sourceRangeStart = $sourceRangeStart;
        $this->rangeLength = $rangeLength;
    }

    public function containsSource(int $source): bool
    {
        return $this->sourceRangeStart <= $source && $this->sourceRangeStart + $this->rangeLength > $source;
    }

    public function doesNotContainSource(int $source): bool
    {
        return !$this->containsSource($source);
    }

    public function mapSource(int $source): int
    {
        if ($this->doesNotContainSource($source)) {
            throw new \InvalidArgumentException('Does not contain source');
        }

        return $this->destinationRangeStart + ($source - $this->sourceRangeStart);
    }
}
