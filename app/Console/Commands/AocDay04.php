<?php

namespace App\Console\Commands;

use App\Aoc\Day04\Pile;
use Illuminate\Console\Command;

class AocDay04 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:4';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 4;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pile = new Pile($this->getDayInputFile());

        $pile->process();

        $total = $pile->totalPoints();

        $this->output->info(sprintf('Total: %s', $total));

        return Command::SUCCESS;
    }

}
