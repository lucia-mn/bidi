<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Club::create([
            'nombre' => 'Barcelona',
            'estadio' => 'Camp Nou',
            'anio_fundacion' => 1899,
            'presidente' => 'Joan Laporta',
            'entrenador' => 'Xavi'
        ]);

        Club::create([
            'nombre' => 'Real Madrid',
            'estadio' => 'Bernabeu',
            'anio_fundacion' => 1902,
            'presidente' => 'Florentino Perez',
            'entrenador' => 'Ancelotti'
        ]);

        Club::create([
            'nombre' => 'Valencia',
            'estadio' => 'Mestalla',
            'anio_fundacion' => 1919,
            'presidente' => 'Layhoon',
            'entrenador' => null
        ]);
    }
}
