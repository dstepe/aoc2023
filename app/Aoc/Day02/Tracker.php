<?php

namespace App\Aoc\Day02;

class Tracker
{
    private \Iterator $input;

    private GameTally $gameTally;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->gameTally = new GameTally();
    }

    public function track(): void
    {
        foreach ($this->input as $input) {
            $this->gameTally->addGame($input);
        }
    }

    public function total(): int
    {
        return $this->gameTally->gameTotal(function (Game $game) {
            return $game->hands(function (Hand $hand) {
                    return $hand->red() > 12 ||
                        $hand->green() > 13 ||
                        $hand->blue() > 14;
                })->count() === 0;
        });
    }

    public function power(): int
    {
        return $this->gameTally->powerTotal();
    }
}
