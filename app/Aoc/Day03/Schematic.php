<?php

namespace App\Aoc\Day03;

use Illuminate\Support\Collection;

class Schematic
{
    private \Iterator $input;
    private Collection $rows;
    private PartNumberGenerator $partNumberGenerator;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->rows = new Collection();
        $this->partNumberGenerator = new PartNumberGenerator();
    }

    public function process(): void
    {
        $rowNumber = 0;
        foreach ($this->input as $input) {
            $row = new Row($rowNumber);
            $columnNumber = 0;
            foreach (str_split($input) as $datum) {
                $point = new Point($datum, $rowNumber, $columnNumber);
                $row->addPoint($point);
                $this->partNumberGenerator->processPoint($point);
                $columnNumber++;
            }

            $this->rows->add($row);
            $rowNumber++;
        }
    }

    public function total(): int
    {
        return $this->partNumbers()->sum(function (PartNumber $partNumber) {
            return $partNumber->value();
        });
    }

    public function gearRatioTotal(): int
    {
        $partNumbers = $this->partNumbers();

        $gearPoints = $this->gearPoints();

        /** @var Collection $gears */
        $gears = $gearPoints->reduce(function (Collection $c, Point $point) use ($partNumbers) {
            $adjacentPartNumbers = $partNumbers->filter(function (PartNumber $partNumber) use ($point) {
                return $partNumber->isAdjacentToPoint($point);
            });

            if ($adjacentPartNumbers->count() === 2) {
                $c->add($adjacentPartNumbers);
            }

            return $c;
        }, new Collection());

        return $gears->sum(function (Collection $partNumbers) {
            $a = $partNumbers->shift();
            $b = $partNumbers->shift();
            return $a->value() * $b->value();
        });
    }

    public function pointAdjacentToSymbol(Point $point): bool
    {
        return $this->neighbors($point)->reduce(function (bool $isAdjacent, Point $point) {
            if ($point->isSymbol()) {
                $isAdjacent = true;
            }
            return $isAdjacent;
        }, false);
    }

    private function partNumbers(): Collection
    {
        return $this->partNumberGenerator->partNumbers()->filter(function (PartNumber $partNumber) {
            return $partNumber->points()->reduce(function (bool $c, Point $point) {
                if ($this->pointAdjacentToSymbol($point)) {
                    $c = true;
                }
                return $c;
            }, false);
        });
    }

    private function neighbors(Point $point): Collection
    {
        $neighbors = new Collection();

        if ($point->row() > 0) {
            // get from row above

            /** @var Collection $row */
            $row = $this->rows->get($point->row() - 1);

            if ($point->column() > 0) {
                $neighbors->add($row->get($point->column() - 1));
            }

            $neighbors->add($row->get($point->column()));

            if ($point->column() + 1 < $row->count()) {
                $neighbors->add($row->get($point->column() + 1));
            }
        }

        if ($point->row() + 1 < $this->rows->count()) {
            // get from row below

            /** @var Collection $row */
            $row = $this->rows->get($point->row() + 1);

            if ($point->column() > 0) {
                $neighbors->add($row->get($point->column() - 1));
            }

            $neighbors->add($row->get($point->column()));

            if ($point->column() + 1 < $row->count()) {
                $neighbors->add($row->get($point->column() + 1));
            }
        }

        /** @var Collection $row */
        $row = $this->rows->get($point->row());

        if ($point->column() > 0) {
            // get left same row
            $neighbors->add($row->get($point->column() - 1));
        }

        if ($point->column() + 1 < $row->count()) {
            // get from right same row
            $neighbors->add($row->get($point->column() + 1));
        }

        return $neighbors;
    }

    private function gearPoints(): Collection
    {
        return $this->rows->reduce(function (Collection $c, Row $row) {
            return $c->merge($row->gearPoints());
        }, new Collection());
    }
}
