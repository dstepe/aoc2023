<?php

namespace App\Aoc\Day15;

class Hasher
{
    private int $currentValue = 0;

    public function hash(string $string)
    {
        $this->initialize();

        foreach (str_split($string) as $char) {
            $this->addAscii($char);
            $this->multiple();
            $this->divide();
        }

        return $this->currentValue;
    }

    private function initialize(): void
    {
        $this->currentValue = 0;
    }

    private function addAscii(string $char): void
    {
        $this->currentValue += ord($char);
    }

    private function multiple(): void
    {
        $this->currentValue *= 17;
    }

    private function divide(): void
    {
        $this->currentValue %= 256;
    }
}
