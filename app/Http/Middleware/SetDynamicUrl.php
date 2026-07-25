<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetDynamicUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getSchemeAndHttpHost() !== config('app.url')) {
            URL::forceRootUrl($request->getSchemeAndHttpHost());
        }

        return $next($request);
    }
}
