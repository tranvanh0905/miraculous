<?php

namespace App\Http\Middleware;

use Closure;

class RequestMiddleware
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
        if ($request->isMethod('get'))
        {
            return redirect(route('client.home'));
        }

        return $next($request);
    }
}
