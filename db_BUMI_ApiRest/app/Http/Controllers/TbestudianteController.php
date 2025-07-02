<?php

namespace App\Http\Controllers;

use App\Models\tbestudiante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbestudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = tbestudiante::all();
        return response()->json($estudiantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cedulaEstudiante' => 'required|string|max:20|min:9|unique:tbestudiante',
            '1er_nombre'   => 'required|string|max:100',
            '2do_nombre'   => 'nullable|string|max:100',
            '1er_ape'      => 'required|string|max:100',
            '2do_ape'      => 'nullable|string|max:100',
            'idcarrera'    => 'required|integer',
            'cedulaTutor'  => 'required|string|max:20',
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante = tbestudiante::create([
            'cedulaEstudiante' => $request->input('cedulaEstudiante'),
            '1er_nombre'   => $request->input('1er_nombre'),
            '2do_nombre'   => $request->input('2do_nombre'),
            '1er_ape'      => $request->input('1er_ape'),
            '2do_ape'      => $request->input('2do_ape'),
            'idcarrera'    => $request->input('idcarrera'),
            'cedulaTutor'  => $request->input('cedulaTutor'),
        ]);

        if(!$estudiante){
            $data = [
                'message'=> 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Estudiante creado correctamente',
            'respuesta' => $estudiante,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estudiante = tbestudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $estudiante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudiante = tbestudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'cedulaEstudiante' => 'required|string|max:20|min:9|unique:tbestudiante',
            '1er_nombre'   => 'required|string|max:100',
            '2do_nombre'   => 'nullable|string|max:100',
            '1er_ape'      => 'required|string|max:100',
            '2do_ape'      => 'nullable|string|max:100',
            'idcarrera'    => 'required|integer',
            'cedulaTutor'  => 'required|string|max:20',
        ]);
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante= $estudiante::update([
            'cedulaEstudiante' => $request->input('cedulaEstudiante'),
            '1er_nombre'   => $request->input('1er_nombre'),
            '2do_nombre'   => $request->input('2do_nombre'),
            '1er_ape'      => $request->input('1er_ape'),
            '2do_ape'      => $request->input('2do_ape'),
            'idcarrera'    => $request->input('idcarrera'),
            'cedulaTutor'  => $request->input('cedulaTutor'),
        ]);

        $estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado correctamente',
            'respuesta' => $estudiante,
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
            $estudiante = tbestudiante::find($id);

            if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado','status'=> 404], 404);
            }

            $estudiante->delete();

            return response()->json(['message' => 'Estudiante eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el estudiante', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }
}
