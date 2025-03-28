<?php

namespace App\Http\Controllers;

use App\Models\Consola;
use Illuminate\Http\Request;
use App\Utils\Helpers;

class ConsolaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listado de consolas
        $listaConsolas = Consola::all();
        return response()->json([
            "status" => "Success",
            "message" => "Recurso encontrado con exito",
            "code" => 200,
            "data" => $listaConsolas],200,[],JSON_PRETTY_PRINT);
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
        $datosValidados=Helpers::validarDatosConsola($request);

        // Comprobamos si ya existe una consola con el mismo nombre en la columna 'nombre'
        $consolaExistente = Consola::where('nombre', $datosValidados['nombre'])->exists();
       
        if($consolaExistente){
            return Helpers::yaExiste($consolaExistente);
        }
        
        $nuevaConsola = Consola::create($datosValidados);

        return response()->json([
            "status" => "Success",
            "message" =>  "Consola creada con exito",
            "code" => 201,
            "data" =>$nuevaConsola], 201,[],JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Localiza consola con id = $id pasado
        $consola = Consola::find($id);

        if ($consola) {
            return response()->json([
                "status" => "Success",
                "message" => "Consola encontrada con exito",
                "code" => 200,
                "data" => $consola],200,[],JSON_PRETTY_PRINT);
        } else{

            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consola $Consola)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $datosValidados=Helpers::validarDatosConsola($request);


        // Comprobamos si ya existe un elemento con este nombre, pero sin que sea el que queremos modificar
        $consolaExistente = Consola::where('nombre', $datosValidados['nombre'])->where('idconsola', '!=', $id)->exists();
       
        if($consolaExistente){
            return Helpers::yaExiste($consolaExistente); // Mensaje de que ya existe
        }

        $consola = Consola::find($id);

        if ($consola) {
            $consola->update($request->all());
            return response()->json([
                "status" => "Success",
                "message" => "Consola con ID: ".$id." actualizada con exito",
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
        $consola = Consola::find($id);
        
        if ($consola) { //Si existe borramos y se muestra la respuesta por pantalla
            $consola->delete();
            return response()->json([
                "status" => "Success",
                "message" =>  "Consola con ID: ".$id." borrada con exito",
                "code" => 204], 200, [], JSON_PRETTY_PRINT); // Pongo 200 para que muestre el mensaje
        } else{
            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }
}
