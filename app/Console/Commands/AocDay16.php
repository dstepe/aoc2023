<?php

namespace App\Console\Commands;

use App\Aoc\Day16\Grid;
use Illuminate\Console\Command;

class AocDay16 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:16';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 16;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $grid = new Grid($this->getDayInputFile());

        $grid->process();

        $this->output->info(sprintf('Energized: %s', $grid->energizedCount()));

        return Command::SUCCESS;
    }

}
