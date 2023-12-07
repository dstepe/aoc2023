<?php

namespace Tests\Unit\Aoc\Day07;

use App\Aoc\Day07\Hand;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HandTest extends TestCase
{
    public function testCreatesFromInput(): void
    {
        $hand = Hand::fromInput('32T3K 765');

        $this->assertEquals(765, $hand->bid());
        $this->assertEquals(Hand::ONE_PAIR, $hand->strength());
    }

    public function testDeterminesIfHandBeatsOpponentByHighCard(): void
    {
        $a = Hand::fromInput('KK677 28');
        $b = Hand::fromInput('KTJJT 220');

        $this->assertTrue($a->beats($b));
        $this->assertFalse($b->beats($a));
    }

    #[DataProvider('strengthChecks')]
    public function testCalculatesStrength(string $input, int $expected): void
    {
        $hand = Hand::fromInput($input);

        $this->assertEquals($expected, $hand->strength());
    }

    public static function strengthChecks(): array
    {
        return [
            'Five of a kind' => ['AAAAA 123', Hand::FIVE_OF_KIND],
            'Four of a kind' => ['AAAAT 123', Hand::FOUR_OF_KIND],
            'Full house' => ['AAATT 123', Hand::FULL_HOUSE],
            'Three of a kind' => ['AAAT9 123', Hand::THREE_OF_KIND],
            'Two pair' => ['AATT9 123', Hand::TWO_PAIR],
            'One pair' => ['AAT98 123', Hand::ONE_PAIR],
            'High card' => ['T9876 123', Hand::HIGH_CARD],
            'Input one pair' => ['32T3K 765', Hand::ONE_PAIR],
            'Input three of a kind 1' => ['T55J5 684', Hand::THREE_OF_KIND],
            'Input two pair 1' => ['KK677 28', Hand::TWO_PAIR],
            'Input two pair 2' => ['KTJJT 220', Hand::TWO_PAIR],
            'Input three of a kind 2' => ['QQQJA 483', Hand::THREE_OF_KIND],
        ];
    }

    #[DataProvider('beatsOpponentChecks')]
    public function testAssertsIfBeatsOpponentHand(Hand $opponent, bool $expected): void
    {
        $hand = Hand::fromInput('AAAT9 123');

        $this->assertEquals($expected, $hand->beats($opponent));
    }

    public static function beatsOpponentChecks(): array
    {
        return [
            'five of a kind, loses' => [Hand::fromInput('AAAAA 123'), false],
            'four of a kind, loses' => [Hand::fromInput('AAAAT 123'), false],
            'full house, loses' => [Hand::fromInput('AAATT 123'), false],
            'three of a kind, loses' => [Hand::fromInput('AAATJ 123'), false],
            'three of a kind, wins' => [Hand::fromInput('AAAT8 123'), true],
            'two pair, wins' => [Hand::fromInput('AATT9 123'), true],
            'one pair, wins' => [Hand::fromInput('AAT98 123'), true],
            'high card, wins' => [Hand::fromInput('A9876 123'), true],
        ];
    }
}
