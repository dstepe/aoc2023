<?php

namespace App\Aoc\Day10;

use Illuminate\Support\Collection;

class Field
{
    private Collection $rows;

    private Position $start;

    public function __construct()
    {
        $this->rows = new Collection();
    }

    public function rowCount(): int
    {
        return $this->rows->count();
    }

    public function addRowFromInput(string $input): void
    {
        $row = new Row();
        $rowNumber = $this->rowCount();

        foreach (str_split($input) as $label) {
            $row->add(new Position(new Type($label), $rowNumber, $row->count()));
        }

        $this->addRow($row);
    }

    /**
     * @throws \Exception
     */
    public function startPosition(): Position
    {
        if (empty($this->start)) {
            $this->findStart();
        }

        return $this->start;
    }

    public function farthestDistance(): int
    {
        $position = $this->startPosition();

        $steps = 0;
        do {
            printf("%s ", $position->label());
            $position = $position->nextPosition();
            $steps++;
        } while ($position->isNotStart());

        return $steps / 2;
    }

    /**
     * @throws \Exception
     */
    private function findStart(): void
    {
        $this->rows->each(function (Row $row) {
            $row->each(function (Position $position) {
                if ($position->isStart()) {
                    $this->start = $position;
                    return false;
                }

                return true;
            });

            return empty($this->start);
        });

        if (empty($this->start)) {
            throw new \Exception('Unable to find start position');
        }
    }

    private function addRow(Row $row): void
    {
        $this->addRowNeighbors($row);

        $this->rows->add($row);
    }

    private function addRowNeighbors(Row $row): void
    {
        $row->sliding(2)->eachSpread(function (Position $west, Position $east) {
            $west->introduceEastNeighbor($east);
            $east->introduceWestNeighbor($west);
        });

        if ($this->rowCount() === 0) {
            return;
        }

        $this->rows->last()->each(function (Position $position) use ($row) {
            /** @var Position $neighbor */
            $neighbor = $row->get($position->column());
            $position->introduceSouthNeighbor($neighbor);
            $neighbor->introduceNorthNeighbor($position);
        });
    }
}
