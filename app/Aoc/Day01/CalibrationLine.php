<?php

namespace App\Aoc\Day01;

class CalibrationLine
{

    private string $line;

    private array $map = [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
    ];

    public function __construct(string $line)
    {
        $this->line = $line;
    }

    public function digits(): int
    {
        return $this->getFirstDigit() . $this->getLastDigit();
    }

    private function getFirstDigit(): string
    {
        return $this->getFirstDigitFromLine(str_split($this->line), $this->map);
    }

    private function getLastDigit(): string
    {
        return $this->getFirstDigitFromLine(array_reverse(str_split($this->line)), $this->reverseSpellingKeys());
    }

    private function reverseSpellingKeys(): array
    {
        return array_reduce(array_keys($this->map), function (array $c, string $spelling) {
            $c[strrev($spelling)] = $this->map[$spelling];
            return $c;
        }, []);
    }

    private function getFirstDigitFromLine(array $characters, array $map): int
    {
        $candidate = '';
        foreach ($characters as $character) {
            if (is_numeric($character)) {
                return $character;
            }

            $candidate .= $character;

            foreach (array_keys($map) as $spelling) {
                if (preg_match("/($spelling)/", $candidate, $matches)) {
                    return $map[$matches[1]];
                }
            }
        }

        throw new \InvalidArgumentException('Could not find digit');
    }
}
