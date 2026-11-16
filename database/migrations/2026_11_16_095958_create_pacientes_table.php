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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->char('dni', 8)->unique();
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['M', 'F']);
            $table->string('telefono', 9)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
