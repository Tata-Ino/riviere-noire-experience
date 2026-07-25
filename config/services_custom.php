<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Services tierces
    |--------------------------------------------------------------------------
    |
    | Configuration pour Kkiapay (paiement en ligne) et autres services.
    |
    */

    'kkiapay' => [
        'public_key' => env('KKIAPAY_PUBLIC_KEY', ''),
        'private_key' => env('KKIAPAY_PRIVATE_KEY', ''),
        'secret_key' => env('KKIAPAY_SECRET_KEY', ''),
        'widget_id' => env('KKIAPAY_WIDGET_ID', ''),
        'callback_url' => env('KKIAPAY_CALLBACK_URL', '/reservation/callback'),
    ],

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK_URL', '#'),
        'instagram' => env('SOCIAL_INSTAGRAM_URL', '#'),
    ],

];
