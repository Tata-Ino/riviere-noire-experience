<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Afficher la liste des lieux actifs.
     */
    public function index()
    {
        $places = Place::active()
            ->with(['translations.language', 'media'])
            ->paginate(9);

        return view('places.index', compact('places'));
    }

    /**
     * Afficher un lieu par son slug.
     */
    public function show(string $slug)
    {
        $place = Place::active()
            ->with([
                'translations.language',
                'media',
                'excursions.translations.language',
                'excursions.media',
                'restaurant.translations.language',
                'restaurant.media',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('places.show', compact('place'));
    }
}
