<?php

namespace App\Aoc\Day04;

use Illuminate\Support\Collection;

class Pile
{
    private \Iterator $input;
    private Collection $cards;
    private int $count = 0;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->cards = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $card = Card::fromInput($input);
            $this->cards->put($card->number(), $card->winningCount());
        }

        $this->cards->keys()->each(function (int $cardNumber) {
            $this->countCards($cardNumber);
        });
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

    public function totalCards(): int
    {
        return $this->count;
    }

    private function countCards(int $cardNumber): void
    {
        $this->count++;
        $limit = $cardNumber + $this->cards->get($cardNumber);
        for ($i = $cardNumber+ 1; $i <= $limit; $i++) {
            $this->countCards($i);
        }

        if ($this->count % 1000 === 0) {
            printf("count: %s\n", $this->count);
        }
    }
}
