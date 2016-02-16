<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Wit.ai API Access Token
    |--------------------------------------------------------------------------
    |
    | Here you may specify your wit.ai API Access Token or set an env variable.
    | ENV Var: WIT_ACCESS_TOKEN
    |
    */
    'access_token' => env('WIT_ACCESS_TOKEN', 'YOUR_WIT_ACCESS_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Asynchronous Requests [Optional]
    |--------------------------------------------------------------------------
    |
    | When set to True, All the requests would be made non-blocking (Async).
    |
    | Default: false
    | Possible Values: (Boolean) "true" OR "false"
    |
    */
    'async_requests' => env('WIT_ASYNC_REQUESTS', false),
];