<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // ← IMPORTANT

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If user is logged in
        if (Auth::check()) {

            // If user is admin
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin') {

                // Prevent admin from accessing login or register
                if (
                    $request->route()->getName() === 'dashboard' ||
                    $request->route()->getName() === 'login' ||
                    $request->route()->getName() === 'register'
                ) {
                    return redirect()->route('admin#home');
                }

                return $next($request);
            }


               return back();
        }

        // Not logged in → allow (for login/register)
        return $next($request);
    }
}
