<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_autor' => env('ROLE_AUTOR', 'Autor'),
        'permissions' => [
            'book_manage_all' => 'book-admin/manage_all'
        ]
    ]

    
];
