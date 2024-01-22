<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Deploy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        /*Redis::funnel('deployments')
            ->limit(5)
            ->block(10)
            ->then(function () {
                info("Started Deploying...");
                sleep(5);
                info("End Deploying");
            });*/

        /*Redis::throttle('deployments')
            ->allow(10)
            ->every(60)
            ->block(10)
            ->then(function () {
                info("Started Deploying...");
                sleep(5);
                info("End Deploying");
            });*/

        //Cache::lock("Deployments")->block(10, function () {
        //});

        info("Started Deploying...");
        sleep(5);
        info("End Deploying");
    }
    public function middleware()
    {
        return [
            new WithoutOverlapping('deployments',10)
        ];
    }
}
