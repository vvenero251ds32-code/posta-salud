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
        Schema::create('personal_medico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()
                  ->constrained()->nullOnDelete();
            $table->char('dni', 8)->unique();
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->string('especialidad', 60);
            $table->string('colegiatura', 10)->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_medico');
    }
};
