<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestModeBlock
{
    public function handle(Request $request, Closure $next)
    {
        // If in guest mode, block access to certain pages
        if (session('guest_mode')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
