<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetFrameAncestors
{
    /**
     * Declare which origins may embed this app in an iframe so the platform
     * builder can render it in its canvas while everything else is refused.
     * Defers to any stricter Content-Security-Policy set further down.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $response->headers->has('Content-Security-Policy')) {
            $response->headers->set(
                'Content-Security-Policy',
                'frame-ancestors '.config('platform.frame_ancestors')
            );
        }

        return $response;
    }
}
