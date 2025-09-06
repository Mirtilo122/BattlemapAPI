<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Hugo',
            'email' => 'hugomoreirabarbosa2@gmal.com',
            'password' => Hash::make('Ka6t892f'),
            'acesso' => 'dm',
        ]);

        User::create([
            'name' => 'Gusthavo',
            'email' => 'gusthavoreberte2005@gmail.com',
            'password' => Hash::make('rebert1234'),
            'acesso' => 'jogador',
        ]);

        User::create([
            'name' => 'Leonardo',
            'email' => 'leonardo-bet@hotmail.com',
            'password' => Hash::make('senha'),
            'acesso' => 'jogador',
        ]);
    }
}
