<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            // para que el campo no se quede vacio en la bd y dé problemas al acceder
            'email_verified_at' => now(),
            'password' => bcrypt('hola1234'),
            'rol' => 'administrador',
        ]);

        // usuario
        User::updateOrCreate([
            'name' => 'Usuario',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => bcrypt('hola1234'),
            'rol' => 'usuario',
        ]);
    }
}