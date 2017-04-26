<?php

namespace App\Console\Commands;

use App\Contento\Blogger;
use Illuminate\Console\Command;

class AutopublishContents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autopublish:contents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command autopublishes based on all users defined parameters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Blogger $blogger)
    {
        $tone = $blogger->AutoPublish();
        $this->info($tone);
    }
}
