<?php

namespace App\Http\Middleware;

use Closure;
use App\SystemEvent;
use Request;

class TrackApiUsage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event = new SystemEvent();

        $event->category = 'api-usage';

        $payload = [
            'url' => Request::path(),
            'ip' => Request::ip()
        ];

        $event->payload = json_encode($payload);

        $event->save();

        return $next($request);
    }
}
