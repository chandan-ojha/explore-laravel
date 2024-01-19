<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    //public $timeout = 1;
    //public $tries = -1;
    //public $backoff = 2;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //throw new \Exception('Failed!');
        sleep(3);
        info("Hello Laravel Queue!");
    }

    /*public function retryUntil()
    {
        return now()->addMinute();
    }*/
}
