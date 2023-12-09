<?php

namespace App\Aoc\Day09;

use Illuminate\Support\Collection;

class ReadingHistory
{
    private Collection $readings;

    private Collection $sequences;

    public static function fromInput(string $input): self
    {
        return new self(new Collection(explode(' ', $input)));
    }

    public function __construct(Collection $readings)
    {
        $this->readings = $readings;

        $this->sequences = new Collection([$this->readings]);
    }

    public function nextValue(): int
    {
        $this->prepare();
        $this->sequences->each(function (Collection $sequence) {
            print $sequence->join(' ') . "\n";
        });
        $this->extrapolate();

        return $this->readings->last();
    }

    private function prepare(): void
    {
        while ($this->isNotZeroed($this->sequences->last())) {
            $this->sequences->add(
                $this->makeNewSequence($this->sequences->last())
            );
        }
    }

    private function isNotZeroed(Collection $sequence): bool
    {
        return $sequence->filter(function (int $value) {
            return $value !== 0;
        })->isNotEmpty();
    }

    private function extrapolate(): void
    {
        $this->sequences->last()->add(0);

        $this->sequences->reverse()->sliding(2)->eachSpread(function (Collection $previous, Collection $next) {
            $next->add($previous->last() + $next->last());
        });
    }

    private function makeNewSequence(Collection $original): Collection
    {
        $sequence = new Collection();

        $original->sliding(2)->eachSpread(function (int $previous, int $next) use ($sequence) {
            $sequence->add($next - $previous);
        });

        return $sequence;
    }
}
