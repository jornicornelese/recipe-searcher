<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | .
    | .
    | .
    |
    */

    'default' => 'spoonacular',

    'connections' => [
        'spoonacular' => [
            'driver' => 'spoonacular',
            'key' => env('SPOONACULAR_API_KEY'),
            'url' => env('SPOONACULAR_API_URL'),
        ],
    ],
];
