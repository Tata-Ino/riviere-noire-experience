<?php

namespace Database\Seeders;

use App\Models\SiteContact;
use Illuminate\Database\Seeder;

class SiteContactSeeder extends Seeder
{
    /**
     * Insère les informations de contact du site.
     */
    public function run(): void
    {
        SiteContact::updateOrCreate(
            ['id' => 1],
            [
                'phone' => '+229 97 00 00 00',
                'whatsapp' => '+229 97 00 00 00',
                'email' => 'contact@rivierenoire-experience.com',
                'maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0!2d2.3833!3d6.4969',
                'facebook_url' => 'https://facebook.com/rivierenoire',
                'instagram_url' => 'https://instagram.com/rivierenoire',
            ]
        );
    }
}
