<?php
return [
    'hosts' => [
        'production' =>  env('TRANZZO_HOST', 'https://cpay.tranzzo.com'),
        'staging' =>  env('TRANZZO_HOST_STAGING', ''),
        'stageEnv' => env('TRANZZO_STAGE_ENV', true),
    ],
];