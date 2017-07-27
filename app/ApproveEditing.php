<?php

namespace App;

class ApproveEditing
{

    function handle()
    {
        $editing = \App\Editing::whereStatus(\App\Editing::CREATED_STATUS)
            ->orderBy('created_at', 'asc')->first();

        if ($editing && $editing->user->profile->score >= 10) $editing->approve();

        if ($editing && $editing->user->profile->score < 10) {
            $editing->status = Editing::PENDING_STATUS;

            $editing->save();
        }
    }

}
