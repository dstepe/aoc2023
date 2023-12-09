<?php

namespace App\Aoc\Day08;

use Illuminate\Support\Collection;

class Navigator
{
    public const START_NODE = 'AAA';
    public const END_NODE = 'ZZZ';

    private \Iterator $input;

    private ?Instructions $instructions = null;

    private Collection $nodes;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->nodes = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            if (empty($input)) {
                continue;
            }

            $this->instructions
                ? $this->addNodeFromInput($input)
                : $this->setInstructionsFromInput($input);
        }
    }

    public function nodes(): Collection
    {
        return $this->nodes;
    }

    public function steps(): int
    {
        $current = self::START_NODE;

        $count = 0;
        foreach ($this->instructions->steps() as $direction) {
            $count++;

            /** @var Node $node */
            $node = $this->nodes->get($current);

            /** @var Node $next */
            $next = $this->nodes->get($node->nodeForDirection($direction));

            if ($next->label() === self::END_NODE) {
                return $count;
            }

            $current = $next->label();
        }

        throw new \InvalidArgumentException('Could not find steps');
    }

    private function setInstructionsFromInput($input): void
    {
        $this->instructions = Instructions::fromInput($input);
    }

    private function addNodeFromInput($input): void
    {
        $node = Node::fromInput($input);
        $this->nodes->put($node->label(), $node);
    }}
