<?php

namespace App\Http\Controllers;

use App\Models\Excursion;

class ExcursionController extends Controller
{
    /**
     * Afficher la liste des excursions actives.
     */
    public function index()
    {
        $excursions = Excursion::active()
            ->with(['translations.language', 'media', 'place'])
            ->get();

        return view('excursions.index', compact('excursions'));
    }

    /**
     * Afficher une excursion par son slug.
     */
    public function show(string $slug)
    {
        $excursion = Excursion::active()
            ->with([
                'translations.language',
                'media',
                'place.translations.language',
                'place.media',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('excursions.show', compact('excursion'));
    }
}
