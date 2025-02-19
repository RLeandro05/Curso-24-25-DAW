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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('ciudad', 60);
            //$table->unsignedBigInteger('superficie_id'); // Clave foránea
            //$table->foreign('superficie_id')->references('id')->on('superficies')->onDelete('cascade'); // Restricción de clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
