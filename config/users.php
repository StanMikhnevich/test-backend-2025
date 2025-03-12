<?php

return [
    'pagination' => [
        'perPage' => 6,
    ],

    'photo' => [
        'url' => 'https://ui-avatars.com/api',
        'size' => 70,
    ],

    'positionsUrl' => 'https://frontend-test-assignment-api.abz.agency/api/v1/positions',

    'token' => [
        'lifetime' => (int)env('REGISTER_TOKEN_LIFETIME', 40),
    ]
];
