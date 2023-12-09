<?php

namespace App\Aoc\Day08;

class Node
{
    public const LEFT = 'L';
    public const RIGHT = 'R';

    private string $label;
    private string $leftNode;
    private string $rightNode;

    public static function fromInput(string $input): self
    {
        if (!preg_match('/([A-Z]{3}) = \(([A-Z]{3}), ([A-Z]{3})\)/', $input, $matches)) {
            throw new \InvalidArgumentException('Could not parse node input');
        }
        return new self($matches[1], $matches[2], $matches[3]);
    }

    public function __construct(string $label, string $leftNode, string $rightNode)
    {
        $this->label = $label;
        $this->leftNode = $leftNode;
        $this->rightNode = $rightNode;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function nodeForDirection(string $direction): string
    {
        switch ($direction) {
            case self::LEFT:
                return $this->leftNode;

            case self::RIGHT:
                return $this->rightNode;
        }

        throw new \InvalidArgumentException('Invalid direction');
    }
}
