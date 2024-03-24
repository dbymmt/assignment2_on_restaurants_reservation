<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsVerified
{
    public function handle($request, Closure $next)
    {
        if (! Auth::user()->hasVerifiedEmail()) {
            return redirect('email/verify');
        }

        return $next($request);
    }
}
