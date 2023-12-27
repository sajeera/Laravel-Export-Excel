<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
