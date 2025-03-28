<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videojuego extends Model
{
    use HasFactory;

    // Clave primaria
    protected $primaryKey = 'idjuego';

    // Asignación de datos
    protected $fillable = [
        'titulo',
        'idcompania',
        'sistema',
        'genero',
    ];

    // No hay columnas sobre información temporal en la BD
    public $timestamps = false;
}
