<?php

return [
    'pagination' => [
        'perPage' => 6,
    ],

    'fakePhotoUrl' => 'https://ui-avatars.com/api',

    'photoOptions' => [
        'method' => 'cover',
        'width' => 70,
        'height' => 70,
    ],

    'positionsUrl' => 'https://frontend-test-assignment-api.abz.agency/api/v1/positions',

    'token' => [
        'lifetime' => (int)env('REGISTER_TOKEN_LIFETIME', 40),
    ]
];
