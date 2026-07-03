<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Platform Builder
    |--------------------------------------------------------------------------
    |
    | Every DevDojo app has a companion builder application where the owner
    | chats with an AI to shape this app in real time. Locally the builder
    | runs at build.test; in production it lives at build.<app-domain>.
    |
    */

    'builder_url' => env('PLATFORM_BUILDER_URL', 'http://build.test'),

    /*
    |--------------------------------------------------------------------------
    | Frame Ancestors
    |--------------------------------------------------------------------------
    |
    | Origins allowed to embed this application in an iframe (the builder
    | canvas). Emitted as a Content-Security-Policy frame-ancestors
    | directive on every web response so anything else is refused.
    |
    */

    'frame_ancestors' => env(
        'PLATFORM_FRAME_ANCESTORS',
        "'self' http://build.test https://build.test https://*.devdojo.app"
    ),

    /*
    |--------------------------------------------------------------------------
    | Bridge Token
    |--------------------------------------------------------------------------
    |
    | Shared secret for server-to-server calls between the builder and this
    | app. When unset, bridge endpoints only respond in the local env.
    |
    */

    'token' => env('PLATFORM_BRIDGE_TOKEN'),

];
