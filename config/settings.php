<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User registration
    |--------------------------------------------------------------------------
    |
    | Allows users registration. It is set true to default.
    |
    */
    'registration' => env('IGROVAYA_REGISTRATION', true),

    /*
    |--------------------------------------------------------------------------
    | User password reset
    |--------------------------------------------------------------------------
    |
    | Allows reset password to the registered user. It is set true to default.
    |
    */
    'reset_password' => env('IGROVAYA_RESET_PASSWORD', true),

    /*
    |--------------------------------------------------------------------------
    | User verification
    |--------------------------------------------------------------------------
    |
    | User verification email. If verification routes can be imported or not.
    | This value is established false by default.
    |
    */
    'email_verification' => env('IGROVAYA_EMAIL_VERIFICATION', true),

    /*
    |--------------------------------------------------------------------------
    | User confirmation
    |--------------------------------------------------------------------------
    |
    | User confirmation email. If confirmation routes can be imported or not.
    | This value is established false by default.
    |
    */
    'email_confirmation' => env('IGROVAYA_RANK_EMAIL_CONFIRMATION', true),
];
