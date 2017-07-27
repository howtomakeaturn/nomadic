<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\UserActivity;

class TrackActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function isActiveToday()
    {
        $num = UserActivity::where('user_id', Auth::user()->id)->where('active_date', date('Y-m-d'))->count();

        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function handle($request, Closure $next)
    {
        if (Auth::check() && !$this->isActiveToday()) {
            $activity = new UserActivity();

            $activity->user_id = Auth::user()->id;

            $activity->active_date = date('Y-m-d');

            $activity->active_time = date('H:i:s');

            $activity->save();
        }

        return $next($request);
    }
}
