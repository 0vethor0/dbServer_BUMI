<?php

namespace App\Http\Controllers;

use App\Models\tbestudiante;
use App\Http\Controllers\Controller;
use App\Models\tbtipousuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbtipousuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipousuario = tbtipousuario::all();
        return response()->json($tipousuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idTipoUsuario' => 'required|string|max:20|min:9|unique:tbtipousuario',
            'tipo'   => 'required|string|max:100',
            'rol_Usuario'   => 'nullable|string|max:100',
            
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tipousuario = tbtipousuario::create([
            'idTipoUsuario' => $request->input('idTipoUsuario'),
            'tipo'   => $request->input('tipo'),
            'rol_Usuario'   => $request->input('rol_Usuario'),
            
        ]);

        if(!$tipousuario){
            $data = [
                'message'=> 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Usurio creado correctamente',
            'respuesta' => $tipousuario,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipousuario = tbtipousuario::find($id);

        if (!$tipousuario) {
            return response()->json(['message' => 'Tipo de usuario no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $tipousuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipousuario = tbtipousuario::find($id);

        if (!$tipousuario) {
            return response()->json(['message' => 'Tipo de usuario no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'idTipoUsuario' => 'required|string|max:20|min:9|unique:tbtipousuario',
            'tipo'   => 'required|string|max:100',
            'rol_Usuario'   => 'nullable|string|max:100',
            
        ]);
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tipousuario= $tipousuario::update([
            'idTipoUsuario' => $request->input('idTipoUsuario'),
            'tipo'   => $request->input('tipo'),
            'rol_Usuario'   => $request->input('rol_Usuario'),
        
        ]);
        $tipousuario->save();
        

        $data = [
            'message' => 'Tipo de usuario actualizado correctamente',
            'respuesta' => $tipousuario,
            'status' => 200
        ];


        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tipousuario = tbtipousuario::find($id);

            if (!$tipousuario) {
            return response()->json(['message' => 'Tipo de usuario no encontrado','status'=> 404], 404);
            }

            $tipousuario->delete();

            return response()->json(['message' => 'Tipo de usuario eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el Tipo de usuario', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }
}
