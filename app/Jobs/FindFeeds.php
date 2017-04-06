<?php

namespace App\Jobs;

use App\Contento\contento;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FindFeeds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $website;
    protected $source;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($website, $source)
    {
        //
        $this->website = $website;
        $this->source = $source;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(contento $aggregate)
    {
        //
        $website = $this->website;
        $source = $this->source;
        $aggregate->FindFeedsFromWebsites($website, $source);
    }
}
