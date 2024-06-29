<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login.index')->with('message', 'Silahkan login');
        }

        $user = Auth::user();
        foreach ($roles as $role) {
            if ($user->role->name === $role) {
                return $next($request);
            }
        }

        return redirect()->route('login.index')->with('message', 'Anda tidak memiliki akses');
    }
}
