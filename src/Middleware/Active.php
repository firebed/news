<?php

namespace Firebed\News\Middleware;

use Closure;
use Illuminate\Http\Request;

class Active
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->user()->active && !$request->user()->hasRole('Super Admin')) {
            abort(403);
        }
        return $next($request);
    }
}
