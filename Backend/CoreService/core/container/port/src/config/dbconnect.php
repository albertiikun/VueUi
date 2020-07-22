<?php

return [
    'CreateDatabase' => [
        'servername' => env('USR_DB_HOST', '127.0.0.1'),
        'username' => env('USR_DB_USERNAME'),
        'password' => env('USR_DB_PASSWORD'),
        'charset' => env('USR_DB_CHARSET', 'utf8mb4'),
        'collation' => env('USR_DB_COLLATION', 'utf8mb4_unicode_ci'),
        'database' => env('USR_DB_DATABASE'),
    ],
];
