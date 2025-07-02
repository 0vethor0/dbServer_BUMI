<?php

namespace App\Http\Controllers;

use App\Models\tbtutor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbtutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()//obtener todos los tutores
    {
        $tutores = tbtutor::all();
        return response()->json($tutores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)//crear un nuevo tutor
    {
        $validator = Validator::make($request->all(), [
            'cedulaTutor' => 'required|string|max:20|min:9|unique:tbtutor',
            '1er_nombre'   => 'required|string|max:100',
            '2do_nombre'   => 'nullable|string|max:100',
            '1er_ape'      => 'required|string|max:100',
            '2do_ape'      => 'nullable|string|max:100',
            'tipoTutor'    => 'required|string|max:100',
            'idAreaInvestigacion'  => 'required|integer',
        ]);

        if($validator->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tutor = tbtutor::create([
            'cedulaTutor' => $request->input('cedulaTutor'),
            '1er_nombre'   => $request->input('1er_nombre'),
            '2do_nombre'   => $request->input('2do_nombre'),
            '1er_ape'      => $request->input('1er_ape'),
            '2do_ape'      => $request->input('2do_ape'),
            'tipoTutor'    => $request->input('tipoTutor'),
            'idAreaInvestigacion'  => $request->input('idAreaInvestigacion'),
        ]);

        if(!$tutor){
            $data = [
                'message'=> 'Error al crear el tutor',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Tutor creado correctamente',
            'respuesta' => $tutor,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)//obtener un tutor por id
    {
        $tutor = tbtutor::find($id);

        if (!$tutor) {
            return response()->json(['message' => 'Tutor no encontrado', 'status'=> 404], 404);
        }

        return response()->json(['respuesta'=> $tutor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)//actualizar un tutor
    {
        $tutor = tbtutor::find($id);

        if (!$tutor) {
            return response()->json(['message' => 'Tutor no encontrado', 'status'=> 404], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'cedulaTutor' => 'required|string|max:20|min:9|unique:tbtutor',
            '1er_nombre'   => 'required|string|max:100',
            '2do_nombre'   => 'nullable|string|max:100',
            '1er_ape'      => 'required|string|max:100',
            '2do_ape'      => 'nullable|string|max:100',
            'tipoTutor'    => 'required|string|max:100',
            'idAreaInvestigacion'  => 'required|integer',
        ]);
        if($validatedData->fails() ) {

            $data = [
                'message' => 'Error en la Validacion de los datos',
                'errors' => $validatedData->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tutor= $tutor::update([
            'cedulaTutor' => $request->input('cedulaTutor'),
            '1er_nombre'   => $request->input('1er_nombre'),
            '2do_nombre'   => $request->input('2do_nombre'),
            '1er_ape'      => $request->input('1er_ape'),
            '2do_ape'      => $request->input('2do_ape'),
            'tipoTutor'    => $request->input('tipoTutor'),
            'idAreaInvestigacion'  => $request->input('idAreaInvestigacion'),
        ]);

        $tutor->save();

        $data = [
            'message' => 'Tutor actualizado correctamente',
            'respuesta' => $tutor,
            'status' => 200
        ];


        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)//eliminar un tutor
    {
        try {
            $tutor = tbtutor::find($id);

            if (!$tutor) {
            return response()->json(['message' => 'Tutor no encontrado','status'=> 404], 404);
            }

            $tutor->delete();

            return response()->json(['message' => 'Tutor eliminado correctamente', 'status'=> 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el tutor', 'error' => $e->getMessage(), ' status' => 500], 500);
        }
    }
}
