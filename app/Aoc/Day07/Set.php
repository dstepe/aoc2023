<?php

namespace App\Aoc\Day07;

use Illuminate\Support\Collection;

class Set
{
    private \Iterator $input;

    private Collection $hands;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->hands = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->hands->add(Hand::fromInput($input));
        }
    }

    public function winnings(): int
    {
        $ranked = $this->rankHands();

//        $ranked->each(function (Hand $hand) {
//            printf("%s: %s\n", $hand->cardLabels(), $hand->strength());
//        });
//
        /** @var Collection $scores */
        $scores = $ranked->reduce(function (Collection $c, Hand $hand) {
            $c->add($hand->bid() * ($c->count() + 1));
            return $c;
        }, new Collection());

        return $scores->sum();
    }

    private function rankHands(): Collection
    {
        return $this->hands->sort(function (Hand $a, Hand $b) {
            return $b->beats($a) ? -1 : 1;
        });
    }
}
