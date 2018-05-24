<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class CheckPermission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null) {
        if (!app('Illuminate\Contracts\Auth\Guard')->guest()) {
            $user = new User;
            #echo $user->can($permission);die;
            if ($user->can($permission)) {
                return $next($request);
            }
        }

        return $request->ajax ? response('Unauthorized.', 401) : redirect('/admin/forbidden');
    }

}
