<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\tbareainvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbareainvestigacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AreasInvestigacion = tbareainvestigacion::all();
        return response()->json($AreasInvestigacion);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
    
            'nomb_Area'   => 'required|string|max:100',
            
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
            'idAreaInvestigacion' => $request->input('idAreaInvestigacion'),
            'nomb_Area'   => $request->input('nomb_Area'),
        ]);

        if(!$estudiante){
            $data = [
                'message'=> 'Error al crear el Area de Investigacion',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Area de Investigacion creada correctamente',
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
        $AreaInvestigacion = tbareainvestigacion::find($id);

        if (!$AreaInvestigacion) {
            return response()->json(['message' => 'Area de Investigacion no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $AreaInvestigacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $AreaInvestigacion = tbareainvestigacion::find($id);

        if (!$AreaInvestigacion) {
            return response()->json(['message' => 'Area de Investigacion no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'idAreaInvestigacion' => 'required|string|max:20|min:9|unique:tbareainvestigacion',
            'nomb_Area'   => 'required|string|max:100',
        ]);
            
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $AreaInvestigacion= $AreaInvestigacion::update([
            'idAreaInvestigacion' => $request->input('idAreaInvestigacion'),
            'nomb_Area'   => $request->input('nomb_Area'),
            
        ]);
        $AreaInvestigacion->save();
        

        $data = [
            'message' => 'Estudiante actualizado correctamente',
            'respuesta' => $AreaInvestigacion,
            'status' => 200
        ];


        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
            $AreaInvestigacion = tbareainvestigacion::find($id);

            if (!$AreaInvestigacion) {
            return response()->json(['message' => 'Area de Investigacion no encontrado','status'=> 404], 404);
            }

            $AreaInvestigacion->delete();

            return response()->json(['message' => 'Area de Investigacion eliminado correctamente', 'status'=> 200]);
    }
}
