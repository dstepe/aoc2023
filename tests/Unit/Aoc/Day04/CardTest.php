<?php

namespace Tests\Unit\Aoc\Day04;

use App\Aoc\Day04\Card;
use App\Aoc\Day04\Numbers;
use App\Aoc\Day04\WinningNumbers;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testCountsWinningNumbers(): void
    {
        $card = new Card(
            1,
            new WinningNumbers([41, 48, 83, 86, 17]),
            new Numbers([83, 86, 6, 31, 17, 9, 48, 53])
        );

        $this->assertEquals(4, $card->winningCount());
    }

    public function testCalculatesWinningValue(): void
    {
        $card = new Card(
            1,
            new WinningNumbers([41, 48, 83, 86, 17]),
            new Numbers([83, 86, 6, 31, 17, 9, 48, 53])
        );

        $this->assertEquals(8, $card->winningValue());
    }
}
