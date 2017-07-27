<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetReviewMedian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:review-median';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $cafes = \App\Cafe::where('status', \App\Cafe::APPROVED_STATUS)->get();

        $service = new \App\SetReviewMedian();

        foreach ($cafes as $cafe) {
            $service->handle($cafe);
        }
    }

}
