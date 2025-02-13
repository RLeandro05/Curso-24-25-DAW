<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }
         // Si no es admin, redirigir o devolver error 403
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Pues eso, va todo bien pero no tienes el Acceso autorizado.');
        return $next($request);
    }
}
}