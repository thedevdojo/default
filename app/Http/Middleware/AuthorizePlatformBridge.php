<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizePlatformBridge
{
    /**
     * Guard bridge endpoints used by the platform builder. Requests must
     * carry the shared token; when no token is configured the endpoints
     * stay open only for local development.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('platform.token');

        if (is_string($token) && $token !== '') {
            abort_unless(
                hash_equals($token, (string) $request->header('X-Platform-Token')),
                401,
                'Invalid platform bridge token.'
            );
        } elseif (! app()->environment('local')) {
            abort(401, 'Platform bridge token is not configured.');
        }

        return $next($request);
    }
}
