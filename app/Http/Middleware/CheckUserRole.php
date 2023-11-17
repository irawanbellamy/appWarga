<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->role == "ADMIN") {
            return $next($request);
        }

        // Jika tidak, redirect atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
        return redirect('/')->with('error', 'Permission denied.');
    }
}
