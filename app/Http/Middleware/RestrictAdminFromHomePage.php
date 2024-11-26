<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminFromHomePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $restricted_role_id): Response
    {
        if(Auth::check() && Auth::user()->role_id == $restricted_role_id){
            return redirect()->route('coursesPage.view');
        }
        return $next($request);
    }
}
