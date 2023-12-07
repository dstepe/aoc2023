<?php

namespace App\Aoc\Day07;

use Illuminate\Support\Collection;

class Hand
{
    public const FIVE_OF_KIND = 7;
    public const FOUR_OF_KIND = 6;
    public const FULL_HOUSE = 5;
    public const THREE_OF_KIND = 4;
    public const TWO_PAIR = 3;
    public const ONE_PAIR = 2;
    public const HIGH_CARD = 1;

    private Collection $cards;
    private int $bid;

    private Collection $summary;

    public static function fromInput(string $input): self
    {
        [$labels, $bid] = explode(' ', $input);

        $cards = array_reduce(str_split($labels), function (Collection $c, string $label) {
            $c->add(Card::fromString($label));
            return $c;
        }, new Collection());

        return new self($cards, $bid);
    }

    public function __construct(Collection $cards, int $bid)
    {
        $this->cards = $cards;
        $this->bid = $bid;

        $this->summarize();
    }

    public function beats(Hand $opponent): bool
    {
        if ($this->strength() > $opponent->strength()) {
            return true;
        }

        if ($this->strength() === $opponent->strength()) {
            for ($i = 0; $i < 5; $i++) {
                if ($this->cards[$i]->strength() === $opponent->cards[$i]->strength()) {
                    continue;
                }

                return $this->cards[$i]->strength() > $opponent->cards[$i]->strength();
            }
        }

        return false;
    }

    public function cardLabels(): string
    {
        return $this->cards->reduce(function (string $c, Card $card) {
            $c .= $card->label();

            return $c;
        }, '');
    }

    public function bid():int
    {
        return $this->bid;
    }

    public function strength(): int
    {
        if ($this->isFiveOfKind()) {
            return self::FIVE_OF_KIND;
        }

        if ($this->isFourOfKind()) {
            return self::FOUR_OF_KIND;
        }

        if ($this->isFullHouse()) {
            return self::FULL_HOUSE;
        }

        if ($this->isThreeOfKind()) {
            return self::THREE_OF_KIND;
        }

        if ($this->isTwoPair()) {
            return self::TWO_PAIR;
        }

        if ($this->isOnePair()) {
            return self::ONE_PAIR;
        }

        if ($this->isHighCard()) {
            return self::HIGH_CARD;
        }

        throw new \InvalidArgumentException('Could not find card strength');
    }

    private function summarize(): void
    {
        $this->summary = $this->cards->countBy(function (Card $card) {
            return $card->label();
        })->sortDesc();
    }

    private function isFiveOfKind(): bool
    {
        return $this->summary->count() === 1;
    }

    private function isFourOfKind(): bool
    {
        if ($this->summary->count() !== 2) {
            return false;
        }

        return $this->summary->first() === 4;
    }

    private function isFullHouse(): bool
    {
        if ($this->summary->count() !== 2) {
            return false;
        }

        return $this->summary->first() === 3;
    }

    private function isThreeOfKind(): bool
    {
        if ($this->summary->count() !== 3) {
            return false;
        }

        return $this->summary->first() === 3;
    }

    private function isTwoPair(): bool
    {
        if ($this->summary->count() !== 3) {
            return false;
        }

        return $this->summary->first() === 2;
    }

    private function isOnePair(): bool
    {
        return $this->summary->count() === 4;
    }

    private function isHighCard(): bool
    {
        return $this->summary->count() === 5;
    }
}
