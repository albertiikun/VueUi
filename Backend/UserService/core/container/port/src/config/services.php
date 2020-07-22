<?php

return [
    'access' => [
        'uri' => env('AUTH_SERVER_URL') . '/api/oauth/access',
        'method' => 'GET',
    ],
    'service-login' => [
        'uri' => env('AUTH_SERVER_URL') . '/api/oauth/token',
        'client-secret' => 'oK4cWbukSqCE192ZPQ1fBjSQZbYNhpWzIQyOU0L2',
        'client-id' => '2',
        'scope' => 'user',
    ],
];
