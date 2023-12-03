<?php

namespace App\Console\Commands;

use App\Aoc\Day03\Schematic;
use Illuminate\Console\Command;

class AocDay03 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 3;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schematic = new Schematic($this->getDayInputFile());

        $schematic->process();

        $total = $schematic->total();

        $this->output->info(sprintf('Total: %s', $total));

        $gearRatio = $schematic->gearRatioTotal();

        $this->output->info(sprintf('Gear ratio total: %s', $gearRatio));

        return Command::SUCCESS;
    }

}
