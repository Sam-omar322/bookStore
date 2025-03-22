<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUpdatePermission
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('update-permission')) {
            return $next($request);
        }

        // Redirect instead of throwing 403 error
        return redirect()->route('gallery.index');
    }
}
