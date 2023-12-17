<?php

namespace App\Console\Commands;

use App\Aoc\Day15\Sequencer;
use Illuminate\Console\Command;

class AocDay15 extends AocDay
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:15';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $day = 15;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sequencer = new Sequencer($this->getDayInputFile());

        $sequencer->process();

        $this->output->info(sprintf('Verification: %s', $sequencer->verificationNumber()));

        return Command::SUCCESS;
    }

}
