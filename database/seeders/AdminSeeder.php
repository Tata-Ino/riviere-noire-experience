<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Crée les utilisateurs administrateurs par défaut.
     */
    public function run(): void
    {
        // Super administrateur principal
        User::updateOrCreate(
            ['email' => 'admin@rivierenoire.com'],
            [
                'name' => 'Admin RNE',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        // Administrateur régulier (manager)
        User::updateOrCreate(
            ['email' => 'manager@rivierenoire.com'],
            [
                'name' => 'Manager',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
