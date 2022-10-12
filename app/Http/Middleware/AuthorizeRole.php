<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     * NOTE: Usage will be by ->middleware('authorizerole:ROLE_ADMIN')
     * make sure that only one role is accepted
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $count = 0;
        foreach ($roles as $role) {
            foreach (Auth::user()->roles as $user_roles) {
                if (strtolower($role) == strtolower($user_roles->role_name)) {
                    $count++;
                }
            }
        }

        if ($count == count($roles)) {
            return $next($request);
        } else {
            return abort(401);
        }
    }
}
