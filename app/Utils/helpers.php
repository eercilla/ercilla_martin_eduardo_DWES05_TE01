<?php
namespace App\Utils;

use App\Models\Compania;

class Helpers{

    function __construct(){

    }

    
    // Funcion para validar los datos que se quieren introducir en la tabla Videojuegos
    public static function validarDatosJuego($request) {

        $datosValidados = $request->validate([
            'titulo' => 'required|string',
            'idcompania' => 'required|integer|exists:companias,idcompania',
            'sistema' => 'required|string',
            'genero' => 'required|string',
        ]);

        return $datosValidados;

    }

    // Funcion para validar los datos que se quieren introducir en la tabla Consolas
    public static function validarDatosConsola($request) {
        

        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'lanzamiento' => 'required|date',
            'idcompania' => 'required|integer|exists:companias,idcompania'
        ]);
        
        return $datosValidados;

    }

    // Funcion para validar los datos que se quieren introducir en la tabla Compania
    public static function validarDatosCompania($request) {


        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'fundacion' => 'required|date',
            'pais' => 'required|string|max:255'
        ]);

        return $datosValidados;

    }

    // Mensaje a mostrar si el nombre ya está en la BD
    public static function yaExiste($datosValidados){

            return response()->json([
                'error' => 'Ya existe un elemento con este nombre o título',
                'code' => 409
            ], 409, [],JSON_PRETTY_PRINT);

    }

    // Mensaje a mostrar si el no se ha encontrado el elemento buscado
    public static function noEncontrado() {
        return response()->json([
            "error" => "Elemento no encontrado",
            "code" => 404
        ], 404, [], JSON_PRETTY_PRINT);
    }

}
?>