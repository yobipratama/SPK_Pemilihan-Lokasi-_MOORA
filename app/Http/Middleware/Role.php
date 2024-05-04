<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role['name'];
            if ($userRole and $userRole == $role) {
                return $next($request);
            }
            Auth::logout();
            return to_route('login.index')->with('message','Anda tidak memiliki akses');
        }
        return to_route('login.index')->with('message','Silahkan login');
    }
}
