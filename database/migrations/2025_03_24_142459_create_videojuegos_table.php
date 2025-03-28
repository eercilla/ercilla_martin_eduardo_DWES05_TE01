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
        if (!Schema::hasTable('videojuegos')) {
            Schema::create('videojuegos', function (Blueprint $table) {
                $table->increments('idjuego'); // Define la clave primaria.
                $table->string('titulo', 255)->unique()->nullable(false); // Campo único para el título.
                $table->unsignedInteger('idcompania'); // unsignedInteger en lugar de integer para que coincida con el tipo de 'idcompania'
                $table->string('sistema', 255);
                $table->string('genero', 255);

                // Definimos la clave foránea para idcompania
                $table->foreign('idcompania')
                    ->references('idcompania')
                    ->on('companias')
                    ->onDelete('cascade'); // Borra videojuegos asociados si la compañía es eliminada.            
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuegos');
    }
};
