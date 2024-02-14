<?php

return [
    'default' => 'main',

    'connections' => [
        'main' => [
            'salt' => env('HASHIDS_SALT', 'my-secret-salt-123'),
            'length' => env('HASHIDS_LENGTH', 10),
        ],
    ],
];
