<?php

namespace App\Console\Commands;

use App\Aoc\Day05\Almanac;
use Illuminate\Console\Command;

class AocDay05 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 5;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $almanac = new Almanac($this->getDayInputFile());

        $almanac->process();

        $this->output->info(sprintf('Lowest location: %s', $almanac->lowestLocation()));

        return Command::SUCCESS;
    }

}
