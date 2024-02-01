<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn cần đăng nhập trước!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return route('login');
        }
    }
}
