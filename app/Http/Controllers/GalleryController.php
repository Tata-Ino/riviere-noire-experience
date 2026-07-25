<?php

namespace App\Http\Controllers;

use App\Models\ExcursionMedia;
use App\Models\PlaceMedia;
use App\Models\RestaurantMedia;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Afficher la galerie multimédia avec filtrage par type.
     */
    public function index(Request $request)
    {
        $type = $request->input('type');

        // Récupérer les médias des lieux
        $placeMedia = PlaceMedia::query()
            ->when($type, fn ($q, $type) => $q->where('type', $type))
            ->with('place')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn ($media) => [
                'id' => $media->id,
                'type' => $media->type,
                'url' => $media->url,
                'source' => $media->place->translate(App()->getLocale())?->name ?? 'Lieu',
                'source_type' => 'place',
            ]);

        // Récupérer les médias des excursions
        $excursionMedia = ExcursionMedia::query()
            ->when($type, fn ($q, $type) => $q->where('type', $type))
            ->with('excursion')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn ($media) => [
                'id' => $media->id,
                'type' => $media->type,
                'url' => $media->url,
                'source' => $media->excursion->translate(App()->getLocale())?->name ?? 'Excursion',
                'source_type' => 'excursion',
            ]);

        // Récupérer les médias des restaurants
        $restaurantMedia = RestaurantMedia::query()
            ->when($type, fn ($q, $type) => $q->where('type', $type))
            ->with('restaurant')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn ($media) => [
                'id' => $media->id,
                'type' => $media->type,
                'url' => $media->url,
                'source' => $media->restaurant->translate(App()->getLocale())?->name ?? 'Restaurant',
                'source_type' => 'restaurant',
            ]);

        // Fusionner et grouper par type
        $media = $placeMedia->merge($excursionMedia)->merge($restaurantMedia);
        $groupedMedia = $media->groupBy('type');

        return view('gallery.index', compact('media', 'groupedMedia', 'type'));
    }
}
