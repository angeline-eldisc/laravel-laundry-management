<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Alert;
use Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        foreach ($roles as $role) {
            if (Auth::user()->role != $role) {
                Alert::info('Oopss..', 'You are prohibited from entering this page.');
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
