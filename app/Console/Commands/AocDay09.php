<?php

namespace App\Console\Commands;

use App\Aoc\Day09\Predictor;
use Illuminate\Console\Command;

class AocDay09 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:9';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 9;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $predictor = new Predictor($this->getDayInputFile());

        $predictor->process();

        $this->output->info(sprintf('Sum: %s', $predictor->sum()));

        return Command::SUCCESS;
    }

}
