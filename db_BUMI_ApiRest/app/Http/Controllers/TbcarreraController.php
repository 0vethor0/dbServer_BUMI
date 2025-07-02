<?php

namespace App\Http\Controllers;

use App\Models\tbcarrera;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbcarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carrera = tbcarrera::all();
        return response()->json($carrera);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreCarrera'   => 'required|string|max:100'
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $carrera = tbcarrera::create([
            'nombreCarrera'   => $request->input('nombreCarrera'),
        ]);
        if(!$carrera){
            $data = [
                'message'=> 'Error al crear la carrera',

                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'carrera creada correctamente',
            'respuesta' => $carrera,
            'status' => 201
        ];


        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carrera = tbcarrera::find($id);

        if (!$carrera) {
            return response()->json(['message' => 'carrera no encontrada', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $carrera]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $carrera = tbcarrera::find($id);

        if (!$carrera) {
            return response()->json(['message' => 'carrera no encontrada', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'nombreCarrera'   => 'required|string|max:100'
        
        ]);
        
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        
        $carrera= $carrera::update([
            'nombreCarrera'   => $request->input('nombreCarrera'),
        ]);

        $carrera->save();
        $data = [
            'message' => 'carrera actualizado correctamente',
            'respuesta' => $carrera,
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
            $carrera = tbcarrera::find($id);

            if (!$carrera) {
            return response()->json(['message' => 'carrera no encontrada','status'=> 404], 404);
            }

            $carrera->delete();

            return response()->json(['message' => 'carrera eliminada correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la carrera', 'error' => $e->getMessage(), ' status' => 500], 500);
        }
    }
}
