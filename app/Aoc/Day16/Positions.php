<?php

namespace App\Aoc\Day16;

use Illuminate\Support\Collection;
use Illuminate\Support\ItemNotFoundException;

class Positions extends Collection
{
    public function addFromRowInput(string $input): void
    {
        $collector = new Collection();

        $rowNumber = $this->nextRowNumber();

        foreach (str_split($input) as $type) {
            $collector->add(new Position(Type::from($type), $rowNumber, $collector->count()));
        }

        $this->push(...$collector->values());
    }

    public function rows(): Collection
    {
        return $this->groupBy(function (Position $position) {
            return $position->row();
        });
    }

    /**
     * @param int $row
     * @param int $column
     * @return Position
     * @throws  ItemNotFoundException
     */
    public function getPosition(int $row, int $column): Position
    {
        return $this->firstOrFail(function (Position $position) use ($row, $column) {
            return $position->row() === $row && $position->column() === $column;
        });
    }

    public function energizedCount(): int
    {
        return $this->filter(function (Position $position) {
            return $position->isEnergized();
        })->count();
    }

    public function printEnergized(): string
    {
        return $this->rows()->reduce(function (Collection $c, Collection $row) {
            $c->add($row->map(function (Position $position) {
//                return $position->isEnergized() ? $position->direction()->value : $position->type()->value;
                return $position->isEnergized() ? '*' : '.';
            })->join(''));
            return $c;
        }, new Collection())->join("\n");
    }

    private function nextRowNumber(): int
    {
        if ($this->isEmpty()) {
            return 0;
        }

        return $this->last()->row() + 1;
    }
}
