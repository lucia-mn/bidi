<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::insert([
            [
                'nombre' => 'Romance',
                'descripcion' => 'Novelas románticas y relaciones personales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Infantil',
                'descripcion' => 'Libros dirigidos al público infantil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Drama',
                'descripcion' => 'Historias centradas en conflictos humanos y emocionales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ciencia ficción',
                'descripcion' => 'Relatos futuristas, espaciales y tecnológicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fantasía',
                'descripcion' => 'Mundos mágicos y elementos sobrenaturales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Terror',
                'descripcion' => 'Historias de suspense, miedo y horror.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Misterio',
                'descripcion' => 'Investigaciones, enigmas y suspense.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fábula',
                'descripcion' => 'Relatos con enseñanzas y moralejas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
