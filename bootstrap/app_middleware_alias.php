<?php

return [
    /*
    |----------------------------------------------------------------------
    | Route Middleware
    |----------------------------------------------------------------------
    |
    | Middlewares personnalisés pour l'application Rivière Noire Experience.
    |
    */

    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'locale' => \App\Http\Middleware\SetLocale::class,
];
