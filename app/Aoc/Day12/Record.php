<?php

namespace App\Aoc\Day12;

use Illuminate\Support\Collection;

class Record
{
    private string $conditions;
    private Groupings $groupings;

    private Matcher $matcher;
    private Collection $arrangements;

    public static function fromInput(string $input): self
    {
        [$conditionsInput, $groupingInput] = explode(' ', $input);

        return new self(
            $conditionsInput,
            new Groupings(new Collection(explode(',', $groupingInput)))
        );
    }

    public function __construct(string $conditions, Groupings $groupings)
    {
        $this->conditions = $conditions;
        $this->groupings = $groupings;

        $this->matcher = new Matcher($this->groupings);
        $this->arrangements = new Collection();
    }

    public function arrangements(): int
    {
        $candidates = $this->generateVariations($this->conditions);

        $this->arrangements = $candidates->filter(function (string $candidate) {
            return $this->matcher->matches($candidate);
        });

        return $this->arrangements->count();
    }

    private function generateVariations(string $input): Collection
    {
        $questionMarkPositions = [];
        $len = strlen($input);

        // Find positions of question marks
        for ($i = 0; $i < $len; $i++) {
            if ($input[$i] == '?') {
                $questionMarkPositions[] = $i;
            }
        }

        // Generate all combinations
        $combinations = [];
        $totalCombinations = pow(2, count($questionMarkPositions));

        for ($i = 0; $i < $totalCombinations; $i++) {
            $combination = $input;

            // Convert decimal to binary and pad with zeros
            $binary = str_pad(decbin($i), count($questionMarkPositions), '0', STR_PAD_LEFT);

            // Replace '?' with '#' based on binary representation
            for ($j = 0; $j < count($questionMarkPositions); $j++) {
                $combination[$questionMarkPositions[$j]] = ($binary[$j] == '1') ? '#' : '?';
            }

            $combinations[] = $combination;
        }

        return new Collection($combinations);
    }
}
