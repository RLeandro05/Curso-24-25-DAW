<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenista>
 */
class TenistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'altura' => $this->faker->numberBetween(170, 200),  // Altura en cm
            'mano' => $this->faker->randomElement(['Diestro', 'Zurdo']),
            'anno_nacimiento' => $this->faker->numberBetween(1960, 2005),
        ];
    }
}
