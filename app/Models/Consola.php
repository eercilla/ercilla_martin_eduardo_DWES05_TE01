<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class consola extends Model
{
    use HasFactory;


    // Clave primaria
    protected $primaryKey = 'idconsola';

    // Asignación de datos
    protected $fillable = [
        'nombre',
        'lanzamiento',
        'idcompania',
    ];

    // No hay columnas sobre información temporal en la BD
    public $timestamps = false;
}
