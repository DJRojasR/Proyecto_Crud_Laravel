<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('pacientes', function (Blueprint $table) {
        $table->id();
        $table->string('dni', 8)->unique();
        $table->string('nombres');
        $table->string('apellidos');
        $table->date('fecha_nacimiento');
        $table->string('telefono')->nullable();
        $table->tinyInteger('estado')->default(1); // 0 inactivo, 1 activo
        $table->timestamps();
        $table->string('created_us')->nullable();
        $table->string('updated_us')->nullable();
        $table->softDeletes(); // deleted_at
        $table->string('deleted_us')->nullable();
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
