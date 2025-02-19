<?php

namespace Database\Factories;

use App\Models\Tenista;
use App\Models\Titulo;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Titulo>
 */
class TituloFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Titulo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anno' => $this->faker->numberBetween(1980, date('Y')), // Año entre 1980 y el año actual
            'tenista_id' => Tenista::inRandomOrder()->first()->id ?? Tenista::factory(), // Selecciona o crea un tenista
            'torneo_id' => Torneo::inRandomOrder()->first()->id ?? Torneo::factory(), // Selecciona o crea un torneo
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
