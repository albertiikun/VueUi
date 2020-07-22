<?php


return [
    'CreateDatabase' => [
        'servername' => env('IDS_DB_HOST','127.0.0.1'),
        'username' => env('IDS_DB_USERNAME'),
        'password' => env('IDS_DB_PASSWORD'),
        'charset' => env('IDS_DB_CHARSET', 'utf8mb4'),
        'collation' => env('IDS_DB_COLLATION', 'utf8mb4_unicode_ci'),
        'database' => env('IDS_DB_DATABASE'),
    ],
];
