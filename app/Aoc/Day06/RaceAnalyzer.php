<?php

namespace App\Aoc\Day06;

use Illuminate\Support\Collection;

class RaceAnalyzer
{
    private \Iterator $input;

    private array $times = [];
    private array $distances = [];
    private Collection $races;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->races = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            if (preg_match('/^(\w+):(.*)/', $input, $matches)) {
                switch ($matches[1]) {
                    case 'Time':
                        $this->times = $this->parseNumbers(trim($matches[2]));
                        break;

                    case 'Distance':
                        $this->distances = $this->parseNumbers(trim($matches[2]));
                        break;

                    default:
                        throw new \InvalidArgumentException('Could not match line');
                }
            }
        }

        $this->makeRaces();
    }

    public function marginOfError(): int
    {
        return $this->races->reduce(function (?int $c, Race $race) {
            if (null === $c) {
                $c = count($race->outperformingOptions());
            } else {
                $c *= count($race->outperformingOptions());
            }

            return $c;
        });
    }

    private function makeRaces(): void
    {
        for ($i = 0, $iMax = count($this->times); $i < $iMax; $i++) {
            $this->races->add(new Race($this->times[$i], $this->distances[$i]));
        }
    }

    private function parseNumbers(string $input): array
    {
        return explode(' ', preg_replace('/ +/', ' ', $input));
    }
}
