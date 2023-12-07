<?php

namespace App\Console\Commands;

use App\Aoc\Day07\Set;
use Illuminate\Console\Command;

class AocDay07 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:7';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 7;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $set = new Set($this->getDayInputFile());

        $set->process();

        $this->output->info(sprintf('Total winnings: %s', $set->winnings()));

        return Command::SUCCESS;
    }

}
