<?php

namespace App\Console\Commands;

use App\Aoc\Day01\Calibrator;
use Illuminate\Console\Command;

class AocDay01 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 1;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $top = $this->option('top');

        $calibrator = new Calibrator($this->getDayInputFile());

        $calibrator->calibrate();

        $total = $calibrator->total();

        $this->output->info(sprintf('Total: %s', $total));

        return Command::SUCCESS;
    }

}
