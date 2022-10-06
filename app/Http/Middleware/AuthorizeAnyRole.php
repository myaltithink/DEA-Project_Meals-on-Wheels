<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeAnyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    //still not working
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if($request->user() === null){
            return redirect('/login');
        }

        if($request->user()->hasAnyRole($roles)){
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
