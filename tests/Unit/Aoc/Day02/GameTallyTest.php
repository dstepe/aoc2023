<?php

namespace Tests\Unit\Aoc\Day02;

use App\Aoc\Day02\Game;
use App\Aoc\Day02\GameTally;
use App\Aoc\Day02\Hand;
use PHPUnit\Framework\TestCase;

class GameTallyTest extends TestCase
{
    public function testMakesGameTallyFromInput(): void
    {
        $tally = new GameTally();

        foreach ($this->gameInputs() as $gameInput) {
            $tally->addGame($gameInput);
        }

        $this->assertEquals(5, $tally->gameCount());
    }

    public function testFiltersGames(): void
    {
        $tally = new GameTally();

        foreach ($this->gameInputs() as $gameInput) {
            $tally->addGame($gameInput);
        }

        $matched = $tally->games(function (Game $game) {
            return $game->hands(function (Hand $hand) {
                return $hand->red() > 12 ||
                    $hand->green() > 13 ||
                    $hand->blue() > 14;
            })->count() === 0;
        });

        $this->assertCount(3, $matched);
    }

    public function testFindsGameTotal(): void
    {
        $tally = new GameTally();

        foreach ($this->gameInputs() as $gameInput) {
            $tally->addGame($gameInput);
        }

        $total = $tally->gameTotal(function (Game $game) {
            return $game->hands(function (Hand $hand) {
                return $hand->red() > 12 ||
                    $hand->green() > 13 ||
                    $hand->blue() > 14;
            })->count() === 0;
        });

        $this->assertEquals(8, $total);
    }

    private function gameInputs(): array
    {
        return [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
        ];
    }
}
