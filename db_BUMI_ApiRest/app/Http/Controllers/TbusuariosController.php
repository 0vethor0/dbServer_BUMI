<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbusuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbusuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = tbusuarios::all();
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|string|max:20|min:9|unique:tbusuarios',
            '1er_NombreUser'   => 'required|string|max:100',
            '1er_ApellidoUser'   => 'nullable|string|max:100',
            'contraseña'   => 'required|string|max:100',
            'idTipoUsuario'   => 'nullable|string|max:100',
            'correo'   => 'required|string|max:100',
            
            
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuarios = tbusuarios::create([
            'id_usuario' => $request->input('id_usuario'),
            '1er_NombreUser'   => $request->input('1er_NombreUser'),
            '1er_ApellidoUser'   => $request->input('1er_ApellidoUser'),
            'contraseña'   => $request->input('contraseña'),
            'idTipoUsuario'   => $request->input('idTipoUsuario'),
            'correo'   => $request->input('correo'),
            
        ]);

        if(!$usuarios){
            $data = [
                'message'=> 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Usurio creado correctamente',
            'respuesta' => $usuarios,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuarios = tbusuarios::find($id);

        if (!$usuarios) {
            return response()->json(['message' => 'usuario no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuarios = tbusuarios::find($id);

        if (!$usuarios) {
            return response()->json(['message' => 'usuario no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'id_usuario' => 'required|string|max:20|min:9|unique:tbtipousuario',
            '1er_NombreUser'   => 'required|string|max:100',
            '1er_ApellidoUser'   => 'nullable|string|max:100',
            'contraseña'   => 'required|string|max:100',
            'idTipoUsuario'   => 'nullable|string|max:100',
            'correo'   => 'required|string|max:100',
            
        ]);
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuarios->id_usuario = $request->input('id_usuario');
        $usuarios->{'1er_NombreUser'} = $request->input('1er_NombreUser');
        $usuarios->{'1er_ApellidoUser'} = $request->input('1er_ApellidoUser');
        $usuarios->contraseña = $request->input('contraseña');
        $usuarios->idTipoUsuario = $request->input('idTipoUsuario');
        $usuarios->correo = $request->input('correo');
        
        $usuarios->save();
        

        $data = [
            'message' => 'usuario actualizado correctamente',
            'respuesta' => $usuarios,
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
            $usuarios = tbusuarios::find($id);

            if (!$usuarios) {
            return response()->json(['message' => 'usuario no encontrado','status'=> 404], 404);
            }

            $usuarios->delete();

            return response()->json(['message' => 'usuario eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }
}
