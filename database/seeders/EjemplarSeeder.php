<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;
use App\Models\Ejemplar;

class EjemplarSeeder extends Seeder
{
    public function run(): void
    {
        $libros = Libro::all();

        foreach ($libros as $libro) {

            for ($i = 1; $i <= $libro->max_prestamos; $i++) {

                Ejemplar::create([
                    'libro_id' => $libro->id,
                    'codigo' => 'EJ-' . $libro->id . '-' . $i
                ]);
            }
        }
    }
}
