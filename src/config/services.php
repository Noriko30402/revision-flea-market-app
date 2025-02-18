<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'public_key' => env('pk_test_51QMgs32Mh5gYIf3NbWZaIN0vgJfPjFU7YZvSombwidJnBPZZNOzFsIYjftCvtcZWBLkCmLDQcUlPue3VwYF2ItWq00hP9x9SYD'),
        'secret_key' => env('sk_test_51QMgs32Mh5gYIf3Nm9XgJYgjv5rZzE7v5xU19geQgelLQsbcxrtp1pwcED0p8KsbjiYkglhVz6y7HWex6YjMTULP00zUnPZeKK'),
],

];
