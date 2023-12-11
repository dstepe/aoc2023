<?php

namespace App\Aoc\Day10;

use Illuminate\Support\Collection;

class Type
{
    public const NORTH = 'N';
    public const SOUTH = 'S';
    public const EAST = 'E';
    public const WEST = 'W';

    public const DIRECTIONS = [
        self::NORTH,
        self::EAST,
        self::SOUTH,
        self::WEST,
    ];

    public const TYPES = [
        '|' => [self::NORTH, self::SOUTH],
        '-' => [self::EAST, self::WEST],
        'L' => [self::NORTH, self::EAST],
        'J' => [self::NORTH, self::WEST],
        '7' => [self::SOUTH, self::WEST],
        'F' => [self::SOUTH, self::EAST],
    ];

    public const START = 'S';

    private string $type;

    public static function invertDirection(string $direction): string
    {
        switch ($direction) {
            case (self::NORTH):
                return self::SOUTH;

            case (self::EAST):
                return self::WEST;

            case (self::SOUTH):
                return self::NORTH;

            case (self::WEST):
                return self::EAST;
        }

        throw new \InvalidArgumentException('Could not invert direction');
    }

    public function __construct(string $label)
    {
        $this->type = $label;
    }

    public function label(): string
    {
        return $this->type;
    }

    public function isStart(): bool
    {
        return $this->type === self::START;
    }

    public function isPipe(): bool
    {
        return $this->isStart() || array_key_exists($this->type, self::TYPES);
    }

    public function isNotPipe(): bool
    {
        return !$this->isPipe();
    }

    public function canMove(string $direction): bool
    {
        // We don't know where Start can move to, so try anything
        if ($this->isStart()) {
            return true;
        }

        if ($this->isNotPipe()) {
            return false;
        }

        return in_array($direction, self::TYPES[$this->type]);
    }

    public function possibleMoves(): array
    {
        if ($this->isStart()) {
            return self::DIRECTIONS;
        }

        return self::TYPES[$this->type];
    }
}
