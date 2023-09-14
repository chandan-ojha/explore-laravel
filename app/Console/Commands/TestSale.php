<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('Today sale notification has been sent to users!');
    }
}
