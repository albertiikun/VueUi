<?php

return [
    'CreateDatabase' => [
        'servername' => env('P_DB_HOST', '127.0.0.1'),
        'username' => env('P_DB_USERNAME'),
        'password' => env('P_DB_PASSWORD'),
        'charset' => env('P_DB_CHARSET', 'utf8mb4'),
        'collation' => env('P_DB_COLLATION', 'utf8mb4_unicode_ci'),
        'database' => env('P_DB_DATABASE'),
    ],
];
