<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Place;
use App\Models\Restaurant;
use App\Models\RestaurantTranslation;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Crée le restaurant associé au lieu "Rivière Noire d'Adjarra".
     */
    public function run(): void
    {
        $fr = Language::where('code', 'fr')->first();
        $en = Language::where('code', 'en')->first();

        $place = Place::where('slug', 'riviere-noire-adjarra')->first();

        if (! $place) {
            $this->command->error('Le lieu "riviere-noire-adjarra" est introuvable. Exécutez PlaceSeeder d\'abord.');

            return;
        }

        $restaurant = Restaurant::updateOrCreate(
            ['id' => 1],
            [
                'place_id' => $place->id,
                'opening_hours' => 'Lun-Sam: 10h-22h, Dim: 10h-16h',
                'status' => 'active',
            ]
        );

        RestaurantTranslation::updateOrCreate(
            ['restaurant_id' => $restaurant->id, 'language_id' => $fr->id],
            [
                'name' => 'Le Ponton de la Rivière Noire',
                'description' => "Le Ponton de la Rivière Noire est un restaurant de bord de rivière offrant une expérience culinaire unique au cœur de la mangrove. Installé sur une terrasse en bois surplombant les eaux sombres de la rivière, ce restaurant propose une cuisine locale authentique préparée avec des produits frais pêchés le jour même.\n\nLe menu met à l'honneur les spécialités de la région : poisson fumé à la braise, crabe de mangrove sauce tomate, igname pilée au yaourt et atassi, accompagnés de sodabi frais ou de vin de palme. Chaque plat est une invitation au voyage gustatif, sublimé par le cadre exceptionnel de la mangrove.\n\nLe restaurant accueille également des animations culturelles le week-end, avec des concerts de musique traditionnelle et des spectacles de danse, créant une atmosphère festive et conviviale.",
            ]
        );

        RestaurantTranslation::updateOrCreate(
            ['restaurant_id' => $restaurant->id, 'language_id' => $en->id],
            [
                'name' => 'The Black River Ponton',
                'description' => "The Black River Ponton is a riverside restaurant offering a unique culinary experience in the heart of the mangrove. Set on a wooden terrace overlooking the dark waters of the river, this restaurant serves authentic local cuisine prepared with fresh products caught the same day.\n\nThe menu highlights regional specialties: smoked fish grilled over embers, mangrove crab in tomato sauce, pounded yam with yogurt and atassi, accompanied by fresh sodabi or palm wine. Each dish is an invitation to a gustatory journey, enhanced by the exceptional setting of the mangrove.\n\nThe restaurant also hosts cultural entertainment on weekends, with traditional music concerts and dance shows, creating a festive and friendly atmosphere.",
            ]
        );
    }
}
