<?php

namespace App\Aoc\Day01;

class CalibrationLine
{

    private string $line;

    public function __construct(string $line)
    {
        $this->line = $line;
    }

    public function digits(): int
    {
        return $this->getDigitsFromLine();
    }

    private function getDigitsFromLine(): int
    {
        $digits = preg_replace('/\D/', '', $this->line);

        return substr($digits, 0, 1) . substr($digits, -1);
    }
}
