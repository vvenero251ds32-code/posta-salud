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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->restrictOnDelete();
            $table->foreignId('personal_medico_id')
                  ->constrained('personal_medico')->restrictOnDelete();
            $table->dateTime('fecha_hora');
            $table->dateTime('fecha_hora_fin');
            $table->string('motivo', 200);
            $table->enum('estado', ['pendiente', 'confirmada', 'atendida', 'cancelada'])
                  ->default('pendiente');
            $table->timestamps();

            $table->index(['personal_medico_id', 'fecha_hora']);
            $table->index(['paciente_id', 'fecha_hora']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
