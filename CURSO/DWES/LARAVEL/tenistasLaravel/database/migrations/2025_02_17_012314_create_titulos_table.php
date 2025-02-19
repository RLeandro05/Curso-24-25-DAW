<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('titulos', function (Blueprint $table) {
            $table->integer('anno'); // Año del título
            $table->unsignedBigInteger('tenista_id'); // Clave foránea a tenistas
            $table->unsignedBigInteger('torneo_id'); // Clave foránea a torneos

            // Definir la clave primaria compuesta
            $table->primary(['anno', 'tenista_id', 'torneo_id']);

            // Definir claves foráneas
            $table->foreign('tenista_id')->references('id')->on('tenistas')->onDelete('cascade');
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulos');
    }
};
