<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthClientMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::guest() || !Auth::user()->isAdmin()) {

            return redirect(route('client.auth.getLogin'));
        }

        return $next($request);
    }
}
