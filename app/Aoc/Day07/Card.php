<?php

namespace App\Aoc\Day07;

class Card
{
    public const STRENGTH = [
        'A' => 13,
        'K' => 12,
        'Q' => 11,
        'J' => 10,
        'T' => 9,
        '9' => 8,
        '8' => 7,
        '7' => 6,
        '6' => 5,
        '5' => 4,
        '4' => 3,
        '3' => 2,
        '2' => 1,
    ];

    private string $label;

    public static function fromString(string $label): self
    {
        self::ensureLabel($label);

        return new self($label);
    }

    public static function ensureLabel(string $label): void
    {
        if (!array_key_exists($label, self::STRENGTH)) {
            throw new \InvalidArgumentException('Label not found');
        }
    }

    private function __construct(string $label)
    {
        $this->label = $label;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function strength(): int
    {
        return self::STRENGTH[$this->label];
    }
}
