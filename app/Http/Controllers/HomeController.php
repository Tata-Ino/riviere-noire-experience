<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use App\Models\Place;
use App\Models\Restaurant;
use App\Models\SiteContact;
use App\Models\Testimonial;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil.
     */
    public function index()
    {
        $locale = App::getLocale();

        // Tous les lieux actifs avec leurs traductions et médias
        $places = Place::active()
            ->with(['translations.language', 'media'])
            ->get();

        // Toutes les excursions actives
        $excursions = Excursion::active()
            ->with(['translations.language', 'media', 'place.translations.language'])
            ->get();

        // Restaurant actif
        $restaurant = Restaurant::active()
            ->with(['translations.language', 'media'])
            ->first();

        // Témoignages publiés (DB)
        $testimonials = Testimonial::published()->latest()->limit(10)->get();

        // Statistiques clés (données statiques)
        $stats = [
            ['value' => '5000+', 'label' => 'Visiteurs'],
            ['value' => '10+', 'label' => 'Destinations'],
            ['value' => '15+', 'label' => 'Excursions'],
            ['value' => '5+', 'label' => 'Années'],
        ];

        // Informations de contact du site
        $contacts = SiteContact::getSettings();

        return view('pages.home', compact(
            'locale',
            'places',
            'excursions',
            'restaurant',
            'testimonials',
            'stats',
            'contacts'
        ));
    }
}
