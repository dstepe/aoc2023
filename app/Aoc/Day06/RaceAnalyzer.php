<?php

namespace App\Aoc\Day06;

use Illuminate\Support\Collection;

class RaceAnalyzer
{
    private \Iterator $input;

    private Race $race;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;
    }

    public function process(): void
    {
        $time = null;
        $distance = null;
        foreach ($this->input as $input) {
            if (preg_match('/^(\w+):(.*)/', $input, $matches)) {
                switch ($matches[1]) {
                    case 'Time':
                        $time = $this->parseNumber(trim($matches[2]));
                        break;

                    case 'Distance':
                        $distance = $this->parseNumber(trim($matches[2]));
                        break;

                    default:
                        throw new \InvalidArgumentException('Could not match line');
                }
            }
        }

        $this->race = new Race($time, $distance);
    }

    public function marginOfError(): int
    {
        $options = $this->race->outperformingOptions();

        $start = $options[0]['time'];
        $end = $options[count($options) - 1]['time'];

        return $end - $start + 1; // to count the first one
    }

    private function parseNumber(string $input): int
    {
        return (int) str_replace(' ', '', $input);
    }
}
