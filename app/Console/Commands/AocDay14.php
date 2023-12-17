<?php

namespace App\Console\Commands;

use App\Aoc\Day14\Control;
use Illuminate\Console\Command;

class AocDay14 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:14';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 14;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $control = new Control($this->getDayInputFile());

        $control->process();

        $this->output->info(sprintf('Total load: %s', $control->totalLoad()));

        return Command::SUCCESS;
    }

}
