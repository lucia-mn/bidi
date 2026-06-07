<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Player;
use App\Models\Club;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Player::class;
    
    public function definition(): array
    {
        return [
            //
            'nombre' => substr($this->faker->firstName(), 0, 10),
            'apellidos' => substr($this->faker->lastName(), 0, 25),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'apodo' => $this->faker->optional()->userName(),
            'club_id' => Club::inRandomOrder()->first()->id,
        ];

        // return [
        //     //
        //     'nombre' => $this->faker->firstName(),
        //     'apellidos' => $this->faker->lastName(),
        //     'dorsal' => $this->faker->numberBetween(1, 99),
        //     'club_id' => $this->faker->randomElement([1,2,3]),
        // ];
    }
}
