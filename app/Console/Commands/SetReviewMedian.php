<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\NomadiCore\Entity;

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
        $cafes = Entity::where('status', Entity::APPROVED_STATUS)->get();

        $service = new \Modules\NomadiCore\SetReviewMedian();

        foreach ($cafes as $cafe) {
            $service->handle($cafe);
        }
    }

}
