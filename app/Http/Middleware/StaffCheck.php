<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user !== null && $user->role == 900 && $user->status == 1) {
                return $next($request);
            } else {
                return redirect()->route('client.home');
            }
        } else {
            return redirect()->route('admin.login');
        }
    }
}
