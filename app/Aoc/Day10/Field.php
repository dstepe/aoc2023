<?php

namespace App\Aoc\Day10;

use Illuminate\Support\Collection;

class Field
{
    private Collection $rows;

    private Position $start;

    private Collection $path;

    public function __construct()
    {
        $this->rows = new Collection();
        $this->path = new Collection();
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

        $this->path = new Collection(); // Ensure reset;
        $this->path->add($position);

        do {
            $position = $position->nextPosition();
            $this->path->add($position);
        } while ($position->isNotStart());

        return $this->path->count() / 2;
    }

    public function containedPositionsCount(): int
    {
        if ($this->path->isEmpty()) {
            $this->farthestDistance();
        }

        /** @var Collection $contained */
        $contained = $this->rows->reduce(function (Collection $c, Row $row) {
            return $row->reduce(function (Collection $c, Position $position) {
                if ($this->pathContains($position)) {
                    $c->add($position);
                }
                return $c;
            }, $c);
        }, new Collection());

//        $contained->each(function (Position $position) {
//            printf("%s\n", $position->coordinates());
//        });
//
        return $contained->count();
    }

    public function printFieldContained(): string
    {
        return $this->rows->reduce(function (Collection $c, Row $row) {
            $c->add($row->printContained());
            return $c;
        }, new Collection())->join("\n");
    }

    private function pathContains(Position $position): bool
    {
        $counter = 0;
        $vertexCount = $this->path->count();
        /** @var Position $candidate1 */
        $candidate1 = $this->path->get(0);

        for ($vertexIndex = 1; $vertexIndex <= $vertexCount; $vertexIndex++) {
            /** @var Position $candidate2 */
            $candidate2 = $this->path->get($vertexIndex % $vertexCount);

            if ($position->row() > min($candidate1->row(), $candidate2->row())) {
                if ($position->row() <= max($candidate1->row(), $candidate2->row())) {
                    if ($position->column() <= max($candidate1->column(), $candidate2->column())) {
                        if ($candidate1->row() !== $candidate2->row()) {
                            $xinters = ($position->row() - $candidate1->row()) * ($candidate2->column() - $candidate1->column()) / ($candidate2->row() - $candidate1->row()) + $candidate1->column();
                        }

                        if ($candidate1->column() === $candidate2->column() || $position->column() <= $xinters) {
                            $counter++;
                        }
                    }
                }
            }

            $candidate1 = $candidate2;
        }

        if ($counter % 2 === 0) {
            return false; // point is outside
        } else {
            $position->setIsContained();
            return true; // point is inside
        }
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


//    $polygon = [
//    ['x' => 0, 'y' => 0],
//    ['x' => 0, 'y' => 1],
//    ['x' => 1, 'y' => 1],
//    ['x' => 1, 'y' => 0]
//    ];
//
//    $point = ['x' => 0.5, 'y' => 0.5];
//
//    var_dump(pointInPolygon($polygon, $point)); // returns bool(true), as the point is inside the polygon
    private function pointInPolygon($polygonVertices, $testPoint) {
        $counter = 0;
        $vertexCount = count($polygonVertices);
        $p1 = $polygonVertices[0];

        for ($vertexIndex = 1; $vertexIndex <= $vertexCount; $vertexIndex++) {
            $p2 = $polygonVertices[$vertexIndex % $vertexCount];

            if ($testPoint['y'] > min($p1['y'], $p2['y'])) {
                if ($testPoint['y'] <= max($p1['y'], $p2['y'])) {
                    if ($testPoint['x'] <= max($p1['x'], $p2['x'])) {
                        if ($p1['y'] != $p2['y']) {
                            $xinters = ($testPoint['y'] - $p1['y']) * ($p2['x'] - $p1['x']) / ($p2['y'] - $p1['y']) + $p1['x'];
                        }

                        if ($p1['x'] == $p2['x'] || $testPoint['x'] <= $xinters) {
                            $counter++;
                        }
                    }
                }
            }

            $p1 = $p2;
        }

        if ($counter % 2 == 0) {
            return false; // point is outside
        } else {
            return true; // point is inside
        }
    }
}
