<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if(request()->routeIs('teacher.*')) {          
                return route('teacher.login_view');
            }

            if(request()->routeIs('student.*')) {          
                return route('student.login_view');
            }

            return route('login');
        }
    }
}
