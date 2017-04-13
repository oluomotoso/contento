<?php

namespace App\Jobs;

use App\Contento\Blogger;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BloggerAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $feed;
    protected $domain;

    public function __construct($feed, $domain)
    {
        $this->feed = $feed;
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Blogger $blogger)
    {
        //
        $blogger->PublishPostTOBlogger($this->feed, $this->domain);
    }
}
