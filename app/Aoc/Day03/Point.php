<?php

namespace App\Aoc\Day03;

class Point
{
    private string $value;
    private int $row;
    private int $column;

    public function __construct(string $value, int $row, int $column)
    {
        $this->value = $value;
        $this->row = $row;
        $this->column = $column;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }

    public function isSymbol(): bool
    {
        return !$this->isEmpty() && !$this->isNumeric();
    }

    public function isNumeric(): bool
    {
        return is_numeric($this->value);
    }

    public function isNotNumeric(): bool
    {
        return !$this->isNumeric();
    }

    public function isEmpty(): bool
    {
        return $this->value === '.';
    }
}
