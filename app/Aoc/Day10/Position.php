<?php

namespace App\Aoc\Day10;

class Position
{
    private Type $type;
    private int $row;
    private int $column;
    private ?string $enteredFrom = null;

    private ?Position $northNeighbor = null;
    private ?Position $eastNeighbor = null;
    private ?Position $southNeighbor = null;
    private ?Position $westNeighbor = null;

    private bool $isContained = false;

    public function __construct(Type $type, int $row, int $column)
    {
        $this->type = $type;
        $this->row = $row;
        $this->column = $column;
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

    public function label(): string
    {
        return $this->type->label();
    }

    public function isStart(): bool
    {
        return $this->type->isStart();
    }

    public function isNotStart(): bool
    {
        return !$this->isStart();
    }

    public function introduceNorthNeighbor(Position $neighbor): void
    {
        $this->northNeighbor = $neighbor;
    }

    public function introduceEastNeighbor(Position $neighbor): void
    {
        $this->eastNeighbor = $neighbor;
    }

    public function introduceSouthNeighbor(Position $neighbor): void
    {
        $this->southNeighbor = $neighbor;
    }

    public function introduceWestNeighbor(Position $neighbor): void
    {
        $this->westNeighbor = $neighbor;
    }

    /**
     * @throws \Exception
     */
    public function nextPosition(): Position
    {
//        if (null === $this->enteredFrom && $this->isNotStart()) {
//            throw new \Exception('Cannot get next position from non Start without entered from');
//        }
//
        if ($this->isStart()) {
            $candidates = $this->type->possibleMoves();
        } else {
            $candidates = Type::DIRECTIONS;
        }

        $direction = $this->selectMoveFrom($candidates);

        $position = $this->neighborTo($direction);

        $position->enterFrom(Type::invertDirection($direction));

        return $position;
    }

    public function enterFrom(string $direction): void
    {
        $this->enteredFrom = $direction;
    }

    public function setIsContained(): void
    {
        $this->isContained = true;
    }

    public function containedLabel(): string
    {
        return $this->isContained ? 'I' : 'O';
    }

    private function selectMoveFrom(array $candidates): string
    {
        foreach ($candidates as $direction) {
            if ($direction === $this->enteredFrom) {
                continue;
            }

            if ($direction === Type::NORTH && !$this->canGoNorth()) {
                continue;
            }

            if ($direction === Type::EAST && !$this->canGoEast()) {
                continue;
            }

            if ($direction === Type::SOUTH && !$this->canGoSouth()) {
                continue;
            }

            if ($direction === Type::WEST && !$this->canGoWest()) {
                continue;
            }

            if ($this->type->canMove($direction)) {
                return $direction;
            }
        }

        throw new \Exception('Could not select next move');
    }

    private function canGoNorth(): bool
    {
        if (null === $this->northNeighbor) {
            return false;
        }

        return $this->northNeighbor->canEnterFromSouth();
    }

    private function canEnterFromSouth(): bool
    {
        return $this->type->canMove(Type::SOUTH);
    }

    private function canGoEast(): bool
    {
        if (null === $this->eastNeighbor) {
            return false;
        }

        return $this->eastNeighbor->canEnterFromWest();
    }

    private function canEnterFromWest(): bool
    {
        return $this->type->canMove(Type::WEST);
    }

    private function canGoSouth(): bool
    {
        if (null === $this->southNeighbor) {
            return false;
        }

        return $this->southNeighbor->canEnterFromNorth();
    }

    private function canEnterFromNorth(): bool
    {
        return $this->type->canMove(Type::NORTH);
    }

    private function canGoWest(): bool
    {
        if (null === $this->westNeighbor) {
            return false;
        }

        return $this->westNeighbor->canEnterFromEast();
    }

    private function canEnterFromEast(): bool
    {
        return $this->type->canMove(Type::EAST);
    }

    private function neighborTo(string $direction): Position
    {
        switch ($direction) {
            case Type::NORTH:
                return $this->northNeighbor;

            case Type::EAST:
                return $this->eastNeighbor;

            case Type::SOUTH:
                return $this->southNeighbor;

            case Type::WEST:
                return $this->westNeighbor;
        }

        throw new \Exception('Invalid direction');
    }
}
