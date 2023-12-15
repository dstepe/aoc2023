<?php

namespace App\Console\Commands;

use App\Aoc\Day13\Observations;
use Illuminate\Console\Command;

class AocDay13 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:13';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 13;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $report = new Observations($this->getDayInputFile());

        $report->process();

        $this->output->info(sprintf('Total: %s', $report->totalValue()));

        return Command::SUCCESS;
    }

}
