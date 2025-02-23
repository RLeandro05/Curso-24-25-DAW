<?php

namespace Database\Seeders;

use App\Models\Titulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TituloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Titulo::factory(30)->create();
    }
}
