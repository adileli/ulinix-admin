<?php

namespace App\Http\Middleware;

use Closure;

class CheckTakeRoute
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
//        file_put_contents('t.log', $request->path());
        return $next($request);
    }
}
