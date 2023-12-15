<?php

namespace App\Aoc\Day13;

use Illuminate\Support\Collection;

class Pattern
{
    private Collection $rows;
    private Collection $columns;

    public static function fromInput(Collection $inputRows): self
    {
        $rows = $inputRows->reduce(function (Collection $c, string $input) {
            $c->add(new Collection(str_split($input)));
            return $c;
        }, new Collection());

        return new self($rows);
    }

    public function __construct(Collection $rows)
    {
        $this->rows = $rows;

        $this->makeColumns();
    }

    public function reflectionValue(): int
    {
        return $this->reflectionPoints()
            ->sum(function (Location $location) {
                return $location->value();
            });
    }

    public function print(): string
    {
        return $this->rows->map(function (Collection $row) {
            return $row->join('');
        })->join("\n");
    }

    private function reflectionPoints(): Collection
    {
        return $this->runSearchFor($this->rows, 'r')
            ->merge($this->runSearchFor($this->columns, 'c'))
            ->filter(function (Location $location) {
                return $this->isFullReflection($location);
            });
    }

    private function runSearchFor(Collection $target, string $type): Collection
    {
        $locations = new Collection();

        for ($i = 0; $i < $target->count() - 1; $i++) {
            /** @var Collection $a */
            $a = $target->get($i);
            /** @var Collection $b */
            $b = $target->get($i + 1);

            if ($a->implode('') === $b->implode('')) {
                $locations->add(new Location($type, $i));
            }
        }

        return $locations;
    }

    private function isFullReflection(Location $location): bool
    {
        switch ($location->type()) {
            case 'c':
                return $this->isFullColumnReflection($location);

            case 'r':
                return $this->isFullRowReflection($location);
        }

        return false;
    }

    private function isFullColumnReflection(Location $location): bool
    {
        $minColumn = 0;
        $maxColumn = $this->columns->count();

        for ($left = $location->start(), $right = $location->start() + 1; $left >= $minColumn && $right < $maxColumn; $left--, $right++) {
            if ($this->columns->get($left)->implode('') !== $this->columns->get($right)->implode('')) {
                return false;
            }
        }

        return true;
    }

    private function isFullRowReflection(Location $location): bool
    {
        $minRow = 0;
        $maxRow = $this->rows->count();

        for ($top = $location->start(), $bottom = $location->start() + 1; $top >= $minRow && $bottom < $maxRow; $top--, $bottom++) {
            if ($this->rows->get($top)->implode('') !== $this->rows->get($bottom)->implode('')) {
                return false;
            }
        }

        return true;
    }

    private function makeColumns(): void
    {
        $this->initializeColumns();

        $this->rows->each(function (Collection $row) {
            $row->each(function (string $value, int $key) {
                $this->columns[$key]->add($value);
            });
        });
    }

    private function initializeColumns(): void
    {
        $this->columns = new Collection();

        $row = $this->rows->first();

        for ($i = 0; $i < $row->count(); $i++) {
            $this->columns->add(new Collection());
        }
    }
}
