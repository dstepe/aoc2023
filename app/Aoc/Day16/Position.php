<?php

namespace App\Aoc\Day16;

use Illuminate\Support\Collection;

class Position
{
    private Type $type;
    private int $row;
    private int $column;

    private bool $energized = false;
    private Direction $direction;

    public function __construct(Type $type, int $row, int $column)
    {
        $this->type = $type;
        $this->row = $row;
        $this->column = $column;
    }

    public function type(): Type
    {
        return $this->type;
    }

    public function isEmpty(): bool
    {
        return $this->type === Type::Space;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }

    public function equals(Position $position): bool
    {
        return $this->row === $position->row && $this->column === $position->column;
    }

    public function energize(Direction $direction): void
    {
        $this->energized = true;
        $this->direction = $direction;
    }

    public function isEnergized(): bool
    {
        return $this->energized;
    }

    public function direction(): Direction
    {
        return $this->direction;
    }

    public function splitsFromTo(Direction $direction): Collection
    {
        switch ($direction) {
            case Direction::Right:
            case Direction::Left:
                if ($this->type === Type::Vertical) {
                    return new Collection([Direction::Up, Direction::Down]);
                }
                if ($this->type === Type::Horizontal) {
                    return new Collection([$direction]);
                }
                break;

            case Direction::Down:
            case Direction::Up:
                if ($this->type === Type::Horizontal) {
                    return new Collection([Direction::Left, Direction::Right]);
                }
                if ($this->type === Type::Vertical) {
                    return new Collection([$direction]);
                }
        }

        return new Collection();
    }

    public function reflectsFromTo(Direction $direction): Collection
    {
        switch ($direction) {
            case Direction::Right:
                if ($this->type === Type::LeftUp) { // \
                    return new Collection([Direction::Down]);
                }
                if ($this->type === Type::RightUp) { // /
                    return new Collection([Direction::Up]);
                }
                break;

            case Direction::Down:
                if ($this->type === Type::LeftUp) { // \
                    return new Collection([Direction::Right]);
                }
                if ($this->type === Type::RightUp) { // /
                    return new Collection([Direction::Left]);
                }
                break;

            case Direction::Left:
                if ($this->type === Type::LeftUp) { // \
                    return new Collection([Direction::Up]);
                }
                if ($this->type === Type::RightUp) { // /
                    return new Collection([Direction::Down]);
                }
                break;

            case Direction::Up:
                if ($this->type === Type::LeftUp) { // \
                    return new Collection([Direction::Left]);
                }
                if ($this->type === Type::RightUp) { // /
                    return new Collection([Direction::Right]);
                }
                break;
        }

        return new Collection();
    }
}
