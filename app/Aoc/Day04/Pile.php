<?php

namespace App\Aoc\Day04;

use Illuminate\Support\Collection;

class Pile
{
    private \Iterator $input;
    private Collection $cards;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->cards = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->cards->add(Card::fromInput($input));
        }
    }

    public function countOfCards(): int
    {
        return $this->cards->count();
    }

    public function totalPoints(): int
    {
        return $this->cards->sum(function (Card $card) {
            return $card->winningValue();
        });
    }
}
