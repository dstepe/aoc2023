<?php

namespace App\Console\Commands;

use App\Aoc\Day10\Mapper;
use Illuminate\Console\Command;

class AocDay10 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 10;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mapper = new Mapper($this->getDayInputFile());

        $mapper->process();

        $this->output->info(sprintf('Sum: %s', $mapper->farthestDistance()));

        return Command::SUCCESS;
    }

}
