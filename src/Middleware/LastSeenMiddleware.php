<?php

namespace HappyDemon\UsrLastly\Middleware;

class LastSeenMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param callable|Closure          $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If we have a logged in user
        if($user = app('UsrLastlyUser')->getUser() != false)
        {
            // Store this page's visit
            app('UsrLastlyRepository')->store($user, $request);
        }

        return $next($request);
    }

}