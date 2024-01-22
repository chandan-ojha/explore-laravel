<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeployProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $container;
    public $site;
    public $latestCommitHash;

    /**
     * Create a new job instance.
     */
    public function __construct(Site $site, $latestCommitHash)
    {
        $this->site = $site;
        $this->latestCommitHash = $latestCommitHash;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app()->container->make('deployer')
            ->deploy(
                $this->latestCommitHash
            );
    }
}
