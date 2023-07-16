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

    'github' => [
        'client_id' => '3823005fd736b2fb982f',
        'client_secret' => '376250762aee1a609a3a9459587b360f6ffef69f',
        'redirect' => 'http://localhost/social-auth/github/callback'
//        'redirect' => 'http://example.com/callback-url',
        #'redirect' => '${APP_URL}/social-auth/github/callback',
    ],

    'facebook' => [
        'client_id' => '976072850398596',
        'client_secret' => '0b7ee805cd44fd5209d43a9d8cc2ad88',
        'redirect' => 'http://localhost/social-auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '1094140113614-gutchl5d2knndmfrq3rqp76viaa8nrt1.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/social-auth/google/callback',
    ],

];
