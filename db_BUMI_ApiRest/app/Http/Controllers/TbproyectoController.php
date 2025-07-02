<?php

namespace App\Http\Controllers;

use App\Models\tbproyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbproyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = tbproyecto::all();
        return response()->json($proyectos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Titulo'   => 'required|string|max:100',
            'objetivo_general'   => 'required|string|max:100',
            'objetivos_especificos'   => 'required|string|max:100',
            'resumen'   => 'required|string|max:100',
            'tipoInvestigacion'  => 'required|string|max:100',
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $proyectos = tbproyecto::create([
            'Titulo'   => $request->input('Titulo'),
            'objetivo_general'   => $request->input('objetivo_general'),
            'objetivos_especificos'   => $request->input('objetivos_especificos'),
            'resumen'   => $request->input('resumen'),
            'tipoInvestigacion'  => $request->input('tipoInvestigacion'),
        ]);

        if(!$proyectos){
            $data = [
                'message'=> 'Error al crear el proyecto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'proyecto creado correctamente',
            'respuesta' => $proyectos,
            'status' => 201
        ];


        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyecto = tbproyecto::find($id);

        if (!$proyecto) {
            return response()->json(['message' => 'proyecto no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $proyecto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proyecto = tbproyecto::find($id);

        if (!$proyecto) {
            return response()->json(['message' => 'proyecto no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'Titulo'   => 'required|string|max:100',
            'objetivo_general'   => 'required|string|max:100',
            'objetivos_especificos'   => 'required|string|max:100',
            'resumen'   => 'required|string|max:100',
            'tipoInvestigacion'  => 'required|string|max:100',
        ]);
        
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $proyecto= $proyecto::update([
            'Titulo'   => $request->input('Titulo'),
            'objetivo_general'   => $request->input('objetivo_general'),
            'objetivos_especificos'   => $request->input('objetivos_especificos'),
            'resumen'   => $request->input('resumen'),
            'tipoInvestigacion'  => $request->input('tipoInvestigacion'),
        ]);

        $proyecto->save();
        $data = [
            'message' => 'proyecto actualizado correctamente',
            'respuesta' => $proyecto,
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
            $proyecto = tbproyecto::find($id);

            if (!$proyecto) {
            return response()->json(['message' => 'proyecto no encontrado','status'=> 404], 404);
            }

            $proyecto->delete();

            return response()->json(['message' => 'proyecto eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el proyecto', 'error' => $e->getMessage(), ' status' => 500], 500);
        }
    }
}
