<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->active == 0) {
            auth()->logout();
            $message = 'Tu cuenta ha sido suspendida. Comuníquese con el administrador.';
            return redirect('/')->with('error', $message);
        }

        return $next($request);
    }
}
