<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Profile;

class RefreshUserScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:user-scores';

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
        $users = User::all();

        foreach($users as $user)
        {
            $user->profile->score = $user->getScore();

            $user->profile->save();
        }
    }

}
