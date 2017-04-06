<?php

namespace App\Console\Commands;

use App\Contento\contento;
use Illuminate\Console\Command;

class FetchFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches all the feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $aggregate;

    public function __construct(contento $aggregate)
    {
        parent::__construct();
        $this->aggregate = $aggregate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $info = $this->aggregate->FetchFeedPosts();
        $this->info($info);
    }
}
