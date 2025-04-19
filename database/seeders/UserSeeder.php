<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@garage.local'],
            [
                'name' => 'Admin Garage',
                'email' => 'admin@garage.local',
                'password' => Hash::make('password'), // Tu peux changer ce mot de passe
                'role' => 'admin',
            ]
        );
    }
}
