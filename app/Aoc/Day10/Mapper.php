<?php

namespace App\Aoc\Day10;

class Mapper
{
    private \Iterator $input;
    private Field $field;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->field = new Field();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->field->addRowFromInput($input);
        }
    }

    public function farthestDistance(): int
    {
        return $this->field->farthestDistance();
    }
}
