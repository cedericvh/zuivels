<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    //     $user = $request->user();
    //     $actions = $request->route()->getAction();

    //     switch( $actions['as'] ) {
    //         case "admins":
    //             if( ! $user->isAdmin() ) {
    //                 //return redirect()->route("dashboard");
    //             }
    //         break;

    //         case "auth.admin":
    //             if( ! $user->isAdmin() ) {
    //                 return redirect(route('admin.auth.getLogin'));
    //             }
    //         break;

    //         // add more cases as you need and check the user "type"

    //         default:

    //         break;
    //     }

    //     return $next($request);

    public function handle($request, Closure $next) {
        if (Auth::guest() || !Auth::guard('admin')) {
            return redirect(route('admin.auth.getLogin'));
        }

        return $next($request);
    }

}
