<?php

namespace App\Aoc\Day13;

use Illuminate\Support\Collection;

class Observations
{
    private \Iterator $input;

    private Collection $patterns;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;

        $this->patterns = new Collection();
    }

    public function process(): void
    {
        $collector = new Collection();
        foreach ($this->input as $input) {
            if (empty($input)) {
                $this->patterns->add(Pattern::fromInput($collector));
                $collector = new Collection();
                continue;
            }

            $collector->add($input);
        }

        if ($collector->isNotEmpty()) {
            $this->patterns->add(Pattern::fromInput($collector));
        }
    }

    public function totalValue(): int
    {
        return $this->patterns->sum(function (Pattern $pattern) {
            try {
                return $pattern->reflectionValue();
            } catch (\Exception $e) {
                print "Could not find reflection for the following pattern\n";
                print $pattern->print();
                exit;
            }
        });
    }
}
