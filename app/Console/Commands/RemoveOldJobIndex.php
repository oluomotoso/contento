<?php

namespace App\Console\Commands;

use App\Contento\contento;
use Illuminate\Console\Command;

class RemoveOldJobIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:oldjobindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes old job indices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $contento;

    public function __construct(contento $contento)
    {
        parent::__construct();
        $this->contento = $contento;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->contento->DeleteOldJobIndices();
    }
}
