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
        // Si la tabla consola ya existe al hacer Migrate no la crea (con Refresh sí se borra)
        if (!Schema::hasTable('companias')) {
            Schema::create('companias', function (Blueprint $table) {
                $table->increments('idcompania'); // Define la clave primaria autoincremental.
                $table->string('nombre', 255)->unique()->nullable(false); // Campo único para el nombre.
                $table->date('fundacion');
                $table->string('pais', 255);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companias');
    }
};
