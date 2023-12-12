<?php

namespace App\Aoc\Day11;

class Position
{
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

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }

    public function coordinates(): string
    {
        return sprintf('%s:%s', $this->row, $this->column);
    }

    public function isGalaxy(): bool
    {
        return $this->label === '#';
    }
}
