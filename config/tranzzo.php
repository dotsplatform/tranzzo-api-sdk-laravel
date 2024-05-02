<?php
return [
    'hosts' => [
        'production' =>  env('TRANZZO_HOST', 'https://api.rozetkapay.com/'),
        'staging' =>  env('TRANZZO_HOST_STAGING', 'https://api.rozetkapay.com/'),
    ],
];