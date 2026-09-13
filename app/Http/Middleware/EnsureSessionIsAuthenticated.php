<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionIsAuthenticated
{
    /**
     * Verifica manualmente la existencia del access_token en la sesión nativa.
     * Deliberadamente NO usa Auth::check() ni guards de Eloquent.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('access_token')) {
            // Guarda la URL solicitada para redirigir tras el login (ver redirect()->intended())
            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}