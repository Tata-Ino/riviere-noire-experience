<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Orchestre l'exécution de tous les seeders dans l'ordre dépendant.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            AdminSeeder::class,
            SiteContactSeeder::class,
            PlaceSeeder::class,
            ExcursionSeeder::class,
            RestaurantSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
