<?php

namespace App\Console\Commands;

use App\Contento\contento;
use Illuminate\Console\Command;

class RemoveOldIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:oldindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command removes old indices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $contento;
    public function __construct(contento $contento)
    {
        $this->contento = $contento;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->contento->DeleteOldIndices();
    }
}
