<?php

namespace App\Aoc\Day13;

class Location
{
    private ?string $type;
    private ?int $start;

    public function __construct(string $type = null, int $start = null)
    {
        $this->type = $type;
        $this->start = $start;
    }

    public function found(): bool
    {
        return $this->type !== null;
    }

    public function notFound(): bool
    {
        return !$this->found();
    }

    public function type(): string
    {
        return $this->type;
    }

    public function start(): int
    {
        return $this->start;
    }

    public function label(): string
    {
        return sprintf('%s%s:%s', $this->type, $this->start, $this->start + 1);
    }

    public function value(): int
    {
        switch ($this->type) {
            case 'c':
                return $this->start + 1;

            case 'r':
                return ($this->start + 1) * 100;
        }

        throw new \Exception('Could not determine value');
    }
}
