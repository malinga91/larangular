<?php

return [

    'config' => [
        'app_id' => env('FACEBOOK_ID'),         // Your GitHub Client ID
        'app_secret' => env('FACEBOOK_SECRET'), // Your GitHub Client Secret
        'default_graph_version' => 'v2.10',
    ],

    'other' => [
        'redirect_url' => env('FACEBOOK_REDIRECT'),
        'scope' => ['email']
    ]

];