<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use Illuminate\Http\Request;
use App\Utils\Helpers;

class CompaniaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listado de companias
        $listaCompanias = Compania::all();
        return response()->json([
            "status" => "Success",
            "message" => "Recurso encontrado con exito",
            "code" => 200,
            "data" => $listaCompanias],200,[],JSON_PRETTY_PRINT);
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
        $datosValidados=Helpers::validarDatosCompania($request);

        // Comprobamos si ya existe un juego con el mismo nombre en la columna 'nombre'
        $companiaExistente = Compania::where('nombre', $datosValidados['nombre'])->exists();

        if($companiaExistente){
            return Helpers::yaExiste($companiaExistente);
        }
    
        $nuevaCompania = Compania::create($datosValidados);
        return response()->json([
            "status" => "Success",
            "message" =>  "Compania creada con exito",
            "code" => 201,
            "data" =>$nuevaCompania], 201,[],JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Localiza compania con id = $id pasado
        $compania = Compania::find($id);

        if ($compania) {
            return response()->json([
                "status" => "Success",
                "message" => "Compania encontrada con exito",
                "code" => 200,
                "data" => $compania],200,[],JSON_PRETTY_PRINT);
        } else{

            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compania $Compania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $datosValidados=Helpers::validarDatosCompania($request);

        
        // Comprobamos si ya existe un elemento con este nombre, pero sin que sea el que queremos modificar
        $companiaExistente = Compania::where('nombre', $datosValidados['nombre'])->where('idcompania', '!=', $id)->exists();

        if($companiaExistente){
            return Helpers::yaExiste($companiaExistente); // Mensaje de que ya existe
        }

        $compania = Compania::find($id);

        if ($compania) {
            $compania->update($request->all());
            return response()->json([
                "status" => "Success",
                "message" => "Compania con ID: ".$id." actualizada con exito",
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
        $compania = Compania::find($id);
        
        if ($compania) { //Si existe borramos y se muestra la respuesta por pantalla
            $compania->delete();
            return response()->json([
                "status" => "Success",
                "message" =>  "Compania con ID: ".$id." borrada con exito",
                "code" => 204], 200, [], JSON_PRETTY_PRINT); // Pongo 200 para que muestre el mensaje
        } else{
            return Helpers::noEncontrado(); // Mensaje de que no está en la BD
        }
    }
}
