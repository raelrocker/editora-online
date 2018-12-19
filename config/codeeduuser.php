<?php

return [
    'email' => [
        'user_created' => [
            'subject' => config('app.name') . ' - Sua conta foi criada'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified'
    ],
    'user_default' => [
        'name' => env('USER_NAME', 'Administrator'),
        'email' => env('USER_EMAIL', 'admin@user.com'),
        'password' => env('USER_PASSWORD','secret')
    ],
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controllers_annotations' => [
            //__DIR__ . '\..\Http\Controllers',
            //__DIR__ . '/../../CodeEduBook/Http/Controllers'
            //'C:\Users\Israel\Documents\Editora\editora-online\Modules\CodeEduUser\Http\Controllers',
            //'C:\Users\Israel\Documents\Editora\editora-online\Modules\CodeEduBook\Http\Controllers'
            //'C:\Users\rael\Projects\editora\Modules\CodeEduUser\Http\Controllers',
            'C:\Users\rael\Projects\editora\Modules\CodeEduBook\Http\Controllers'
        ]
    ]
];
