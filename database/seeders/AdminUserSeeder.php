<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur admin principal
        User::create([
            'name' => 'Administrateur Noorea',
            'email' => 'admin@noorea.sn',
            'password' => Hash::make('admin123456'),
            'role' => 'admin',
            'is_active' => true,
            'phone' => '+221 77 123 45 67',
            'city' => 'Dakar',
            'address' => '123 Avenue de la Beauté, Plateau, Dakar',
            'email_verified_at' => now(),
        ]);

        // Créer un utilisateur client de test
        User::create([
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'is_active' => true,
            'phone' => '+221 77 987 65 43',
            'city' => 'Dakar',
            'address' => '456 Rue des Clients, Almadies, Dakar',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Utilisateur admin créé avec succès!');
        $this->command->info('Email: admin@noorea.sn');
        $this->command->info('Mot de passe: admin123456');
        $this->command->warn('IMPORTANT: Changez le mot de passe par défaut après la première connexion!');
    }
}
