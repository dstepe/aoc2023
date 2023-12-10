<?php

namespace App\Aoc\Day08;

use Illuminate\Support\Collection;

class Navigator
{
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
        $steps = $this->startNodes()->reduce(function (Collection $c, string $label) {
            $c->add($this->stepsForNode($label));
            return $c;
        }, new Collection());

        return $this->findLcm($steps->toArray());
    }

    private function gcd(int $a, int $b): int
    {
        if ($b === 0) {
            return $a;
        }

        return $this->gcd($b, $a % $b);
    }

    private function findLcm(array $arr): int
    {
        $n = count($arr);
        $ans = $arr[0];

        for ($i = 1; $i < $n; $i++)
            $ans = ((($arr[$i] * $ans)) /
                ($this->gcd($arr[$i], $ans)));

        return $ans;
    }

    private function stepsForNode(string $current): int
    {
        $count = 0;
        foreach ($this->instructions->steps() as $direction) {
            $count++;

            /** @var Node $node */
            $node = $this->nodes->get($current);

            /** @var Node $next */
            $next = $this->nodes->get($node->nodeForDirection($direction));

            if (preg_match('/.{2}Z$/', $next->label())) {
                return $count;
            }

            $current = $next->label();
        }

        throw new \InvalidArgumentException('Could not find steps');
    }

    public function steps2(): int
    {
        $current = $this->startNodes();

        $count = 0;
        foreach ($this->instructions->steps() as $direction) {
            $count++;

            $current->transform(function (string $label) use ($direction) {
                /** @var Node $node */
                $node = $this->nodes->get($label);

                if (null === $node) {
                    throw new \Exception('Unable to find node ' . $label);
                }

                /** @var Node $next */
                return $this->nodes->get($node->nodeForDirection($direction))->label();
            });

            $atEnd = $current->filter(function (string $label) {
                return preg_match('/.{2}Z$/', $label);
            });

            if ($current->count() === $atEnd->count()) {
                return $count;
            }

            if ($count % 1000 === 0) {
                print "Count $count\n";
            }
        }

        throw new \InvalidArgumentException('Could not find steps');
    }

    public function startNodes(): Collection
    {
        return $this->nodes->reduce(function (Collection $c, Node $node) {
            if (preg_match('/.{2}A$/', $node->label())) {
                $c->add($node->label());
            }

            return $c;
        }, new Collection());
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
