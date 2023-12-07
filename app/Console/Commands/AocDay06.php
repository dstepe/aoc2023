<?php

namespace App\Console\Commands;

use App\Aoc\Day06\RaceAnalyzer;
use Illuminate\Console\Command;

class AocDay06 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:6';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 6;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $analyzer = new RaceAnalyzer($this->getDayInputFile());

        $analyzer->process();

        $this->output->info(sprintf('Margin of error: %s', $analyzer->marginOfError()));

        return Command::SUCCESS;
    }

}
