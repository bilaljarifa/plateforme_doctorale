<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceLocalhostDomain
{
    /**
     * Force all requests from 127.0.0.1 to redirect to localhost
     */
    public function handle(Request $request, Closure $next)
    {
        // If the request comes from 127.0.0.1, redirect to localhost
        if (strpos($request->getHost(), '127.0.0.1') !== false) {
            $url = str_replace('127.0.0.1', 'localhost', $request->url());
            return redirect($url, 301);
        }

        return $next($request);
    }
}
