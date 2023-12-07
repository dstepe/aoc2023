<?php

namespace App\Aoc\Day06;

class Race
{
    private int $time;
    private int $recordDistance;

    public function __construct(int $time, int $recordDistance)
    {
        $this->time = $time;
        $this->recordDistance = $recordDistance;
    }

    public function outperformingOptions(): array
    {
        $options = [];

        foreach ($this->allOptions() as $option) {
            if ($option['distance'] > $this->recordDistance) {
                $options[] = $option;
            }
        }

        return $options;
    }

    private function allOptions(): \Iterator
    {
        for ($i = 0; $i <= $this->time; $i++) {
            yield ['time' => $i, 'distance' => ($this->time - $i) * $i];
        }
    }
}
