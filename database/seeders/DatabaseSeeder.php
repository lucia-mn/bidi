<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // categorias
        $this->call([
            CategoriaSeeder::class,
        ]);

        // usuarios
        $this->call([
            UserSeeder::class,
        ]);

        // libros
        $this->call([
            LibroSeeder::class,
        ]);
        
        // ejemplares
        $this->call([
            EjemplarSeeder::class,
        ]);

    }
}
