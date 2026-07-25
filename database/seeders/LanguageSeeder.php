<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Insère les 3 langues supportées par la plateforme.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'fr', 'name' => 'Français', 'is_active' => true],
            ['code' => 'en', 'name' => 'English', 'is_active' => true],
            ['code' => 'pt', 'name' => 'Português', 'is_active' => true],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(
                ['code' => $lang['code']],
                $lang
            );
        }
    }
}
