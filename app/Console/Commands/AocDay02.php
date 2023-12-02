<?php

namespace App\Console\Commands;

use App\Aoc\Day02\Tracker;
use Illuminate\Console\Command;

class AocDay02 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 2;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tracker = new Tracker($this->getDayInputFile());

        $tracker->track();

        $total = $tracker->total();

        $this->output->info(sprintf('Total: %s', $total));

        return Command::SUCCESS;
    }

}
