<?php

namespace App\Aoc\Day12;

use Illuminate\Support\Collection;

class Report
{
    private \Iterator $input;
    
    private Collection $records;

    public function __construct(\Iterator $input)
    {
        $this->input = $input;
        
        $this->records = new Collection();
    }

    public function process(): void
    {
        foreach ($this->input as $input) {
            $this->records->add(Record::fromInput($input));
        }
    }

    public function totalArrangements(): int
    {
        return $this->records->sum(function (Record $record) {
            return $record->arrangements();
        });
    }
}
