<?php

namespace App\Console\Commands;

use App\Aoc\Day11\ImageProcessor;
use Illuminate\Console\Command;

class AocDay11 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:11';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 11;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $imageProcessor = new ImageProcessor($this->getDayInputFile());

        $imageProcessor->process();

        $this->output->info(sprintf('Total: %s', $imageProcessor->totalDistance()));

        return Command::SUCCESS;
    }

}
