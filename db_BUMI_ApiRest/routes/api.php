<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TbestudianteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/consultar_todos_los_estudiantes', [TbestudianteController::class, 'index']);
Route::get('/consultar_estudiante/{id}', [TbestudianteController::class, 'show']);
Route::post('/crear_estudiante', [TbestudianteController::class, 'store']);
Route::patch('/actualizar_estudiante/{id}', [TbestudianteController::class, 'update']);
Route::delete('/eliminar_estudiante/{id}', [TbestudianteController::class, 'destroy']);
