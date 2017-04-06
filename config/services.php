<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '587728527868-g6vsd92s72sp6ldqj4fgujmtfrqm7peu.apps.googleusercontent.com',
        'client_secret' => 'BkmDgeHQepiuxGjsFUxonqM6',
        'redirect' => 'https://www.loftysms.com/login/google/callback'
    ],
    'facebook' => [
        'client_id' => '750981271736320',
        'client_secret' => 'bbad22bb414a8df03da6c4d23ab82dc2',
        'redirect' => 'https://www.loftysms.com/login/facebook/callback',
    ],
    'twitter' => [
        'client_id' => 'KT67fRP2bv67T7ELJGk0mmqV8',
        'client_secret' => '9EL4WOdGNaKFPvmLsYWGqHzgDnGRThiIzvUg7wIPJjo9Db3ju5',
        'redirect' => 'https://www.loftysms.com/login/twitter/callback',
    ],

];
