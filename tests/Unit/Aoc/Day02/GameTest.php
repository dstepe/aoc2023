<?php

namespace Tests\Unit\Aoc\Day02;

use App\Aoc\Day02\Game;
use App\Aoc\Day02\Hand;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testParsesGameIdFromInput(): void
    {
        $game = Game::fromInput('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertEquals(1, $game->id());
    }

    public function testParsesGameHandsFromInput(): void
    {
        $game = Game::fromInput('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertEquals(3, $game->handCount());
    }

    public function testGameHandsCanBeFiltered(): void
    {
        $game = Game::fromInput('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $hands = $game->hands(function (Hand $hand) {
            return $hand->blue() < 5;
        });

        $this->assertCount(2, $hands);
    }
}
