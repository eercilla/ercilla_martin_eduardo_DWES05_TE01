<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use App\Utils\Helpers;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Listado de juegos
        $listaJuegos = Videojuego::all();
        return response()->json([
            "status" => "Success",
            "message" => "Recurso encontrado con exito",
            "code" => 200,
            "data" => $listaJuegos],200,[],JSON_PRETTY_PRINT);
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Probamos a validar los datos
        $datosValidados=Helpers::validarDatosJuego($request);

        // Comprobamos si ya existe un juego con el mismo título en la columna 'título'
        $juegoExistente = Videojuego::where('titulo', $datosValidados['titulo'])->exists();

        if($juegoExistente){
            return Helpers::yaExiste($juegoExistente); // Mensaje de que ya existe
        }
    
        $nuevoJuego = Videojuego::create($datosValidados);
        return response()->json([
            "status" => "Success",
            "message" =>  "Juego creado con exito",
            "code" => 201,
            "data" =>$nuevoJuego], 201,[],JSON_PRETTY_PRINT);
    }
    

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        // Localiza videojuego con id = $id pasado
        $juego = Videojuego::find($id);

        if ($juego) {
            return response()->json([
                "status" => "Success",
                "message" => "Juego encontrado con exito",
                "code" => 200,
                "data" => $juego],200,[],JSON_PRETTY_PRINT);
        } else{

            return Helpers::noEncontrado(); // Mensaje de que no está en la BD

        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $Videojuego)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $datosValidados=Helpers::validarDatosJuego($request);

         // Comprobamos si ya existe un elemento con este título, pero sin que sea el que queremos modificar
        $juegoExistente = Videojuego::where('titulo', $datosValidados['titulo'])->where('idjuego', '!=', $id)->exists();

        if($juegoExistente){
            return Helpers::yaExiste($juegoExistente); // Mensaje de que ya existe
        }

        $juego = Videojuego::find($id);

        if ($juego) {
            $juego->update($request->all());
            return response()->json([
                "status" => "Success",
                "message" => "Juego con ID: ".$id." actualizado con exito",
                "code" => 204], 200, [], JSON_PRETTY_PRINT); // Pongo 200 para que muestre el mensaje
        } else{
            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $juego = Videojuego::find($id);
        
        if ($juego) { //Si existe borramos y se muestra la respuesta por pantalla
            $juego->delete();
            return response()->json([
                "status" => "Success",
                "message" =>  "Juego con ID: ".$id." borrado con exito",
                "code" => 204], 200, [], JSON_PRETTY_PRINT); // Pongo 200 para que muestre el mensaje
        } else{
            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }
    
}
