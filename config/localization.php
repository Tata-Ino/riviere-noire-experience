<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locale
    |--------------------------------------------------------------------------
    |
    | Le locale par défaut de l'application (français).
    |
    */

    'default' => env('APP_LOCALE', 'fr'),

    'fallback' => env('APP_FALLBACK_LOCALE', 'fr'),

    'faker_locale' => 'fr_FR',

    'delta' => true,

    /*
    |--------------------------------------------------------------------------
    | Locales disponibles
    |--------------------------------------------------------------------------
    */

    'locales' => [
        'fr' => ['FR', 'Français'],
        'en' => ['US', 'English'],
        'pt' => ['BR', 'Português'],
    ],

    'use_session_locale' => true,

    'redirect_to_root' => true,

    'hide_default_locale_in_url' => true,

];
