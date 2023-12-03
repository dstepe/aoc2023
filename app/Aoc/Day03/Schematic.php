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
        $partNumbers = $this->partNumberGenerator->partNumbers()->filter(function (PartNumber $partNumber) {
            return $partNumber->points()->reduce(function (bool $c, Point $point) {
                if ($this->pointAdjacentToSymbol($point)) {
                    $c = true;
                }
                return $c;
            }, false);
        });

        return $partNumbers->sum(function (PartNumber $partNumber) {
            return $partNumber->value();
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
}
