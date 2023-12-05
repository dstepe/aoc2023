<?php

namespace App\Aoc\Day05;

use Illuminate\Support\Collection;

class Almanac
{
    private \Iterator $input;
    private Collection $seeds;
    private Collection $maps;
    private string $currentMap = '';

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->seeds = new Collection();

        $this->createMaps();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->processLine($input);
        }
    }

    public function seeds(): Collection
    {
        return $this->seeds;
    }

    public function lowestLocation(): int
    {
        return $this->seeds->min(function (int $seed) {
            return $this->mapSeedToLocation($seed);
        });
    }

    public function mapSeedToLocation(int $seed): int
    {
        return $this->maps->reduce(function (int $source, Map $map) {
            return $map->findDestination($source);
        }, $seed);
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

        $this->seeds->push(...explode(' ', $matches[1]));
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

        $this->maps[$this->currentMap]->add(new MapEntry(...explode(' ', $line)));
    }

    private function createMaps(): void
    {
        $this->maps = new Collection();

        $this->maps->put('seed-to-soil', new Map());
        $this->maps->put('soil-to-fertilizer', new Map());
        $this->maps->put('fertilizer-to-water', new Map());
        $this->maps->put('water-to-light', new Map());
        $this->maps->put('light-to-temperature', new Map());
        $this->maps->put('temperature-to-humidity', new Map());
        $this->maps->put('humidity-to-location', new Map());
    }
}
