<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Langues autorisées pour le site.
     */
    protected array $allowedLocales = ['fr', 'en', 'pt'];

    /**
     * Changer la langue de l'application.
     */
    public function switch(string $locale): RedirectResponse
    {
        // Vérifier que la langue est autorisée
        if (!in_array($locale, $this->allowedLocales)) {
            abort(400, 'Langue non supportée.');
        }

        // Stocker la langue dans la session
        session(['locale' => $locale]);
        App()->setLocale($locale);

        return redirect()->back();
    }
}
