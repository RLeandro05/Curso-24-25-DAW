<?php

namespace Database\Factories;

use App\Models\Tenista;
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

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenista::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'altura' => $this->faker->numberBetween(160, 210), // Altura en cm entre 160 y 210
            'mano' => $this->faker->randomElement(['Diestro', 'Zurdo']), // Mano dominante aleatoria
            'anno_nacimiento' => $this->faker->numberBetween(1980, 2010), // Año de nacimiento entre 1980 y 2010
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
