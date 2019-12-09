<?php

namespace App\Http\Middleware;

use App\Http\Requests\LoginRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
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
            if ($user !== null && $user->role >= 600 && $user->status == 1) {
                return $next($request);
            } else {
                return view('admin2.403');
            }
        } else {
            return redirect()->route('admin.login');
        }
    }
}
