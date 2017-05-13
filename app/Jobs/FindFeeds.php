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
    protected $feed_type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($website, $source, $feed_type)
    {
        //
        $this->website = $website;
        $this->source = $source;
        $this->feed_type = $feed_type;
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
        $feed_type = $this->feed_type;
        $aggregate->FindFeedsFromWebsites($website, $source,$feed_type);
    }
}
