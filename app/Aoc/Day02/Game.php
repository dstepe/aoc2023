<?php

namespace App\Aoc\Day02;

use Illuminate\Support\Collection;

class Game
{
    private string $input;
    private int $id;
    private Collection $hands;

    public static function fromInput(string $input): self
    {
        return new self($input);
    }

    public function __construct(string $input)
    {
        $this->input = $input;

        $this->parseInput();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function handCount(): int
    {
        return $this->hands->count();
    }

    public function hands(?callable $filter = null): Collection
    {
        if (null === $filter) {
            return $this->hands;
        }

        return $this->hands->filter($filter);
    }

    private function parseInput(): void
    {
        $this->id = $this->findGameId();
        $this->hands = $this->findHands();
    }

    private function findGameId(): int
    {
        if (preg_match('/Game (\d+):/', $this->input, $matches)) {
            return $matches[1];
        }

        throw new \InvalidArgumentException('Could not find Game ID');
    }

    private function findHands(): Collection
    {
        if (!preg_match('/: (.*)/', $this->input, $matches)) {
            throw new \InvalidArgumentException('Could not find game hands');
        }

        $hands = new Collection();
        foreach (explode('; ', $matches[0]) as $handInput) {
            $hands->add(Hand::fromInput($handInput));
        }

        return $hands;
    }
}
