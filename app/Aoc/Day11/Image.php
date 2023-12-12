<?php

namespace App\Aoc\Day11;

use Illuminate\Support\Collection;

class Image
{
    private Collection $rows;

    public function __construct()
    {
        $this->rows = new Collection();
    }

    public function addRowFromInput(string $input): void
    {
        $row = new Row();

        $rowNumber = $this->rows->count();

        foreach (str_split($input) as $label) {
            $row->add(new Position($label, $rowNumber, $row->count()));
        }

        $this->rows->add($row);
    }

    public function expand(): void
    {
        $this->expandRows();

        $this->expandColumns();
    }

    public function galaxyPairs(): Collection
    {
        /** @var Collection $galaxies */
        $galaxies = $this->rows->reduce(function (Collection $c, Row $row) {
            return $row->reduce(function (Collection $c, Position $position) {
                if ($position->isGalaxy()) {
                    $c->add($position);
                }
                return $c;
            }, $c);
        }, new Collection());

        return $this->generateGalaxyPairs($galaxies);
    }

    private function generateGalaxyPairs(Collection $galaxies): Collection
    {
        $pairs = new Collection();

        $count = $galaxies->count();

        for($i = 0; $i < $count; $i++) {
            for($j = $i + 1; $j < $count; $j++) {
                $pairs[] = [$galaxies[$i], $galaxies[$j]];
            }
        }

        return $pairs;
    }

    public function distanceBetween(Position $a, Position $b): int
    {
        return abs($a->row() - $b->row()) + abs($a->column() - $b->column());
    }

    public function totalGalaxyDistances(): int
    {
        return $this->galaxyPairs()->reduce(function (int $c, array $pair) {
            return $c + $this->distanceBetween($pair[0], $pair[1]);
        }, 0);
    }

    public function print(): string
    {
        return $this->rows->reduce(function (Collection $c, Row $row) {
            $c->add($row->print());
            return $c;
        }, new Collection())->join("\n");
    }

    private function addEmptyRow(): void
    {
        $rowNumber = $this->rows->count() + 1;
        $columns = $this->rows->first()->count();

        $row = new Row();

        for ($i = 0; $i < $columns; $i++) {
            $row->add(new Position('.', $rowNumber, $i));
        }

        $this->rows->add($row);
    }

    private function expandRows(): void
    {
        $originalRows = $this->rows;
        $this->rows = new Collection();

        while ($originalRows->isNotEmpty()) {
            $row = $originalRows->shift();

            $this->rows->add($row);

            if ($row->hasNoGalaxy()) {
                $this->addEmptyRow();

                $originalRows->each(function (Row $row) {
                    $row->transform(function (Position $position) {
                        return new Position($position->label(), $position->row() + 1, $position->column());
                    });
                });
            }
        }
    }

    private function expandColumns(): void
    {
        $originalRows = $this->rows;
        $this->rows = new Collection();

        $originalRows->each(function () {
            $this->rows->add(new Row());
        });

        $columnCount = $originalRows->first()->count();

        for ($i = 0; $i < $columnCount; $i++) {
            /** @var Row $column */
            $column = $originalRows->reduce(function (Row $c, Row $row) {
                $c->add($row->shift());
                return $c;
            }, new Row());

            $this->addColumn($column);

            if ($column->hasNoGalaxy()) {
                $this->addEmptyColumn();

                $originalRows->each(function (Row $row) {
                    $row->transform(function (Position $position) {
                        return new Position($position->label(), $position->row(), $position->column() + 1);
                    });
                });
            }
        }
    }

    private function addColumn(Collection $column): void
    {
        $rowCount = $this->rows->count();

        for ($i = 0; $i < $rowCount; $i++) {
            $this->rows->get($i)->add($column->get($i));
        }
    }

    private function addEmptyColumn(): void
    {
        $rowCount = $this->rows->count();

        for ($i = 0; $i < $rowCount; $i++) {
            /** @var Row $row */
            $row = $this->rows->get($i);
            $row->add(new Position('.', $i, $row->count()));
        }
    }
}
