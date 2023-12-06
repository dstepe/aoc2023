<?php

namespace App\Aoc\Day05;

use Illuminate\Support\Collection;

class Almanac
{
    private \Iterator $input;
    private array $seeds = [];
    private array $maps = [];
    private string $currentMap = '';

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->createMaps();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->processLine($input);
        }
    }

    public function lowestLocationOld(): int
    {
        $count = 0;
        $lowest = PHP_INT_MAX;
        foreach ($this->expandSeeds() as $seed) {
            $count++;

            if ($count % 1000 === 0) {
                print "count: $count ($lowest)\n";
            }

            $location = $this->mapSeedToLocation($seed);

            $lowest = min($lowest, $location);
        }

        return $lowest;
    }

    public function lowestLocation(): int
    {
        $count = 0;
        foreach ($this->expandLocations() as $location) {
            $count++;

            if ($count % 10000 === 0) {
                print "count: $count ($location)\n";
            }

            $seed = $this->mapLocationToSeed($location);

            if ($this->hasSeed($seed)) {
                return $location;
            }
        }

        throw new \InvalidArgumentException('Could not find lowest location');
    }

    public function mapSeedToLocation(int $seed): int
    {
        return array_reduce($this->maps, function (int $source, array $map) {
            $destination = $source;

            for ($i = 0, $iMax = count($map); $i < $iMax; $i++) {
                if ($source >= $map[$i]['sourceRangeStart'] && $source <= $map[$i]['sourceRangeEnd']) {
                    $destination = $map[$i]['destinationRangeStart'] + ($source - $map[$i]['sourceRangeStart']);
                }
            }

            return $destination;
        }, $seed);
    }

    public function mapLocationToSeed(int $location): int
    {
        return array_reduce(array_reverse($this->maps), function (int $destination, array $map) {
            $source = $destination;

            for ($i = 0, $iMax = count($map); $i < $iMax; $i++) {
                if ($destination >= $map[$i]['destinationRangeStart'] && $destination <= $map[$i]['destinationRangeEnd']) {
                    $source = $map[$i]['sourceRangeStart'] + ($destination - $map[$i]['destinationRangeStart']);
                }
            }

            return $source;
        }, $location);
    }

    private function expandSeeds(): \Iterator
    {
        foreach ($this->seeds as $seedSpec) {
            $limit = $seedSpec['start'] + $seedSpec['length'];
            for ($i = $seedSpec['start']; $i < $limit; $i++) {
                yield $i;
            }
        }
    }

    private function expandLocations(): \Iterator
    {
        $start = PHP_INT_MAX;
        $end = 0;
        foreach ($this->seeds as $seedSpec) {
            $start = min($start, $seedSpec['start']);
            $end = max($end, $seedSpec['start'] + $seedSpec['length']);
        }

        foreach ($this->maps as $map) {
            foreach ($map as $mapEntry) {
                $start = min($start, $mapEntry['destinationRangeStart']);
                $end = max($end, $mapEntry['destinationRangeEnd']);
            }
        }

        print "Start at $start, end at $end\n";
        for ($i = $start; $i < $end; $i++) {
            yield $i;
        }
    }

    private function hasSeed(int $seed): bool
    {
        foreach ($this->seeds as $seedSpec) {
            if ($seed >= $seedSpec['start'] && $seed < $seedSpec['start'] + $seedSpec['length']) {
                return true;
            }
        }

        return false;
    }

    private function processLine(string $line): void
    {
        if (empty($line)) {
            return;
        }

        $this->checkSeedsLine($line);
        $this->checkMapHeaderLine($line);
        $this->checkMapLine($line);
    }

    private function checkSeedsLine(string $line): void
    {
        if (!preg_match('/^seeds: (.*)/', $line, $matches)) {
            return;
        }

        $seedSpecs = explode(' ', $matches[1]);

        while (!empty($seedSpecs)) {
            $this->seeds[] = [
                'start' => array_shift($seedSpecs),
                'length' => array_shift($seedSpecs)
            ];
        }
    }

    private function checkMapHeaderLine(string $line): void
    {
        if (!preg_match('/(.*) map:$/', $line, $matches)) {
            return;
        }

        $this->currentMap = $matches[1];
    }

    private function checkMapLine(string $line): void
    {
        if (!preg_match('/^[\d ]+$/', $line)) {
            return;
        }

        [$destinationRangeStart, $sourceRangeStart, $rangeLength] = explode(' ', $line);
        $this->maps[$this->currentMap][] = [
            'destinationRangeStart' => $destinationRangeStart,
            'destinationRangeEnd' => (int) $destinationRangeStart + (int) $rangeLength - 1,
            'sourceRangeStart' => $sourceRangeStart,
            'sourceRangeEnd' => (int) $sourceRangeStart + (int) $rangeLength - 1,
            'rangeLength' => $rangeLength,
        ];
    }

    private function createMaps(): void
    {
        $this->maps['seed-to-soil'] = [];
        $this->maps['soil-to-fertilizer'] = [];
        $this->maps['fertilizer-to-water'] = [];
        $this->maps['water-to-light'] = [];
        $this->maps['light-to-temperature'] = [];
        $this->maps['temperature-to-humidity'] = [];
        $this->maps['humidity-to-location'] = [];
    }
}
