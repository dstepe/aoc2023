<?php

namespace App\Console\Commands;

use App\Aoc\Day08\Navigator;
use Illuminate\Console\Command;

class AocDay08 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:8';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 8;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $navigator = new Navigator($this->getDayInputFile());

        $navigator->process();

        $this->output->info(sprintf('Steps: %s', $navigator->steps()));

        return Command::SUCCESS;
    }

}
