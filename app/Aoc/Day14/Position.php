<?php

namespace App\Aoc\Day14;

class Position
{
    public const EMPTY = '.';
    public const CUBE = '#';
    public const ROUND = 'O';

    private string $label;
    private int $row;
    private int $column;

    public function __construct(string $label, int $row, int $column)
    {
        $this->label = $label;
        $this->row = $row;
        $this->column = $column;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function coordinates(): string
    {
        return sprintf('%s:%s', $this->row, $this->column);
    }

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }

    public function isEmpty(): bool
    {
        return $this->label === self::EMPTY;
    }

    public function isRounded(): bool
    {
        return $this->label === self::ROUND;
    }

    public function isCube(): bool
    {
        return $this->label === self::CUBE;
    }

    public function isFixed(): bool
    {
        return !$this->isRounded();
    }

    public function canRollTo(Position $position): bool
    {
        if ($this->isFixed()) {
            return false;
        }

        if ($position->isCube()) {
            return false;
        }

        return $position->isEmpty();
    }

    public function moveTo(Position $position): void
    {
        $position->label = $this->label;
        $this->label = self::EMPTY;
    }

    public function load(): int
    {
        if ($this->isCube() || $this->isEmpty()) {
            return 0;
        }

        return MaximumLoad::limit() - $this->row;
    }
}
