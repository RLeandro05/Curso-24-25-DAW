<?php

namespace Database\Factories;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Torneo>
 */
class TorneoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Torneo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word . ' Open', // Nombre aleatorio con "Open" agregado
            'ciudad' => $this->faker->city, // Ciudad aleatoria
            //'superficie_id' => Superficie::inRandomOrder()->first()->id ?? Superficie::factory(), // Clave foránea a una superficie existente o generada
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
