<?php
return [
    'hosts' => [
        'production' =>  env('TRANZZO_HOST', ''),
        'staging' =>  env('TRANZZO_HOST_STAGING', ''),
        'stageEnv' => env('TRANZZO_STAGE_ENV', true),
    ],
];