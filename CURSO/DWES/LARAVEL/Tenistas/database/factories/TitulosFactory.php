<?php

namespace Database\Factories;

use App\Models\Tenista;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Titulos>
 */
class TitulosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anno' => $this->faker->year,
            'tenista_id' => Tenista::inRandomOrder()->first()->id,  // Asigna un tenista aleatorio
            'torneo_id' => Torneo::inRandomOrder()->first()->id,    // Asigna un torneo aleatorio
        ];
    }
}
