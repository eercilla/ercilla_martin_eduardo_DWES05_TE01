<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compania extends Model
{
    use HasFactory;

    // Clave primaria
    protected $primaryKey = 'idcompania';

    // Asignación de datos
    protected $fillable = [
        'nombre',
        'fundacion',
        'pais',
    ];

    // No hay columnas sobre información temporal en la BD
    public $timestamps = false;
}
