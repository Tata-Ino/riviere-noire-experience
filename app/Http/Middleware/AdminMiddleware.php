<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware de vérification du rôle admin.
 * Redirige vers l'accueil si l'utilisateur n'est pas admin ou super_admin.
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->hasAdminRole()) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
