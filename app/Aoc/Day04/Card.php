<?php

namespace App\Aoc\Day04;

class Card
{
    private int $id;
    private WinningNumbers $winningNumbers;
    private Numbers $numbers;

    public static function fromInput(string $input): self
    {
        if (!preg_match('/Card +(\d+): (.*)\|(.*)/', $input, $matches)) {
            throw new \InvalidArgumentException('Invalid input format');
        }

        $id = $matches[1];
        $winningNumbers = new WinningNumbers(self::parseNumbers($matches[2]));
        $numbers = new Numbers(self::parseNumbers($matches[3]));

        return new self($id, $winningNumbers, $numbers);
    }

    public static function parseNumbers(string $input): array
    {
        return explode(' ', str_replace('  ', ' ', trim($input)));
    }

    public function __construct(int $id, WinningNumbers $winningNumbers, Numbers $numbers)
    {
        $this->id = $id;
        $this->winningNumbers = $winningNumbers;
        $this->numbers = $numbers;
    }

    public function number(): int
    {
        return $this->id;
    }

    public function copyToNumber(): int
    {
        return $this->id + $this->winningCount();
    }

    public function winningCount(): int
    {
        return $this->numbers->intersect($this->winningNumbers)->count();
    }

    public function winningValue(): int
    {
        $count = $this->winningCount();

        return 2 ** ($count - 1);
    }
}
