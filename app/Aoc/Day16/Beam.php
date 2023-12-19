<?php

namespace App\Aoc\Day16;

use Illuminate\Support\Collection;
use Illuminate\Support\ItemNotFoundException;

class Beam
{
    private Position $nextPosition;
    private Direction $direction;
    private Positions $positions;

    private bool $offGrid = false;
    private Collection $next;

    public function __construct(Position $nextPosition, Direction $direction, Positions $positions)
    {
        $this->nextPosition = $nextPosition;
        $this->direction = $direction;
        $this->positions = $positions;
    }

    public function offGrid(): void
    {
        $this->offGrid = true;
    }

    public function isOnGrid(): bool
    {
        return !$this->offGrid;
    }

    public function isOffGrid(): bool
    {
        return $this->offGrid;
    }

    public function advance(): Collection
    {
        $this->next = new Collection();

        if ($this->nextPosition->isEnergized() && $this->nextPosition->direction() === $this->direction) {
            return $this->next;
        }

        $this->nextPosition->energize($this->direction);

        if ($this->nextPosition->isEmpty()) {
            $this->addNextForDirection($this->direction);
        }

        $this->nextPosition->splitsFromTo($this->direction)->each(function (Direction $direction) {
            $this->addNextForDirection($direction);
        });

        $this->nextPosition->reflectsFromTo($this->direction)->each(function (Direction $direction) {
            $this->addNextForDirection($direction);
        });

        if ($this->next->isEmpty()) {
            $this->offGrid();
        }

        return $this->next;
    }

    private function addNextForDirection(Direction $direction): void
    {
        $row = $this->nextPosition->row();
        $column = $this->nextPosition->column();

        switch ($direction) {
            case Direction::Right:
                $column += 1;
                break;

            case Direction::Left:
                $column -= 1;
                break;

            case Direction::Down:
                $row += 1;
                break;

            case Direction::Up:
                $row -= 1;
                break;
        }

        try {
            $this->next->add(new Beam($this->positions->getPosition($row, $column), $direction, $this->positions));
        } catch (ItemNotFoundException $e) {

        }
    }
}
