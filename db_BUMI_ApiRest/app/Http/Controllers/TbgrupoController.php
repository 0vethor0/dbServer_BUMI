<?php

namespace App\Http\Controllers;

use App\Models\tbgrupo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbgrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = tbgrupo::all();
        return response()->json($grupos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cedulaEstudiante' => 'required|string|max:20|min:9',
            'idproyecto' => 'required|integer',
            'periodoAcademico'=> 'required|string|max:50',
            'nombreGrupo' => 'required|string|max:100',
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $grupo = tbgrupo::create([
            'cedulaEstudiante' => $request->input('cedulaEstudiante'),
            'idproyecto' => $request->input('idproyecto'),
            'periodoAcademico'=> $request->input('periodoAcademico'),
            'nombreGrupo' => $request->input('nombreGrupo'),
        ]);
        if(!$grupo){
            $data = [
                'message'=> 'Error al crear el grupo',

                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Grupo creado correctamente',
            'respuesta' => $grupo,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $grupo = tbgrupo::find($id);

        if (!$grupo) {
            return response()->json(['message' => 'Grupo no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $grupo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $grupo = tbgrupo::find($id);

        if (!$grupo) {
            return response()->json(['message' => 'Grupo no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'cedulaEstudiante' => 'required|string|max:20|min:9',
            'idproyecto' => 'required|integer',
            'periodoAcademico'=> 'required|string|max:50',
            'nombreGrupo' => 'required|string|max:100',
        ]);
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $grupo= $grupo::update([
            'cedulaEstudiante' => $request->input('cedulaEstudiante'),
            'idproyecto' => $request->input('idproyecto'),
            'periodoAcademico'=> $request->input('periodoAcademico'),
            'nombreGrupo' => $request->input('nombreGrupo'),
        ]);

        $grupo->save();

        $data = [
            'message' => 'Grupo actualizado correctamente',
            'respuesta' => $grupo,
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
            $grupo = tbgrupo::find($id);

            if (!$grupo) {
            return response()->json(['message' => 'Grupo no encontrado','status'=> 404], 404);
            }

            $grupo->delete();

            return response()->json(['message' => 'Grupo eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el grupo', 'error' => $e->getMessage(), ' status' => 500], 500);
        }
    }
}
