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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id(); // id autoincrement PK
            $table->unsignedBigInteger('cc')->unique(); // cédula numérica, única
            $table->string('nombre_estudiante', 80);
            $table->unsignedBigInteger('codigocurso');
            $table->string('nombre_curso', 80);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
