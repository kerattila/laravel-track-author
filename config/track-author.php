<?php

return [
    'models' => [
        'user' => \App\User::class
    ],
    'columns' => [
        'createdByColumnName' => 'created_by',
        'updatedByColumnName' => 'updated_by',
        'deletedByColumnName' => 'deleted_by',
    ]
];
