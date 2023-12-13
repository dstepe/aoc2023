<?php

namespace App\Console\Commands;

use App\Aoc\Day12\Report;
use Illuminate\Console\Command;

class AocDay12 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:12';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 12;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $report = new Report($this->getDayInputFile());

        $report->process();

        $this->output->info(sprintf('Total: %s', $report->totalArrangements()));

        return Command::SUCCESS;
    }

}
