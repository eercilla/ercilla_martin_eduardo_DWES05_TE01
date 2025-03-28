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
        if (!Schema::hasTable('consolas')) {
            Schema::create('consolas', function (Blueprint $table) {
                $table->increments('idconsola'); // Define la clave primaria autoincremental.
                $table->string('nombre', 255)->unique()->nullable(false); // Campo único para el nombre.
                $table->date('lanzamiento');
                $table->unsignedInteger('idcompania'); // unsignedInteger en lugar de integer para que coincida con el tipo de 'idcompania'

                // Definimos la clave foránea para idcompania
                $table->foreign('idcompania')
                    ->references('idcompania')
                    ->on('companias')
                    ->onDelete('cascade'); // Borra consolas asociadas si la compañía es eliminada.            
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consolas');
    }
};
