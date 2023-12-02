<?php

namespace App\Aoc\Day02;

use Illuminate\Support\Collection;

class GameTally
{
    private Collection $games;

    public function __construct()
    {
        $this->games = new Collection();
    }

    public function addGame(string $input): void
    {
        $this->games->add(Game::fromInput($input));
    }

    public function gameCount(): int
    {
        return $this->games->count();
    }

    public function games(?callable $filter = null): Collection
    {
        if (null === $filter) {
            return $this->games;
        }

        return $this->games->filter($filter);
    }

    public function gameTotal(?callable $filter = null): int
    {
        return $this->games($filter)->reduce(function (int $total, Game $game) {
            $total += $game->id();
            return $total;
        }, 0);
    }

    public function powerTotal(): int
    {
        /** @var Collection $cubeSets */
        $cubeSets = $this->games->reduce(function (Collection $sets, Game $game) {
            $sets->add($game->cubeSet());
            return $sets;
        }, new Collection());

        return $cubeSets->reduce(function (int $total, CubeSet $cubeSet) {
            $total += $cubeSet->power();
            return $total;
        }, 0);
    }
}
