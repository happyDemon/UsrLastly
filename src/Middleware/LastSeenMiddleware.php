<?php

namespace HappyDemon\UsrLastly\Middleware;
use Closure;

class LastSeenMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param callable          $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If we have a logged in user
        $user = app('UsrLastlyUser')->getUser();
        if($user != false)
        {
            // Store this page's visit
            app('UsrLastlyRepository')->store($user, $request);
        }

        return $next($request);
    }

}
