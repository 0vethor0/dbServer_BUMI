<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TbestudianteController;
use App\Http\Controllers\TbtutorController;
use App\Http\Controllers\TbusuariosController;
use App\Http\Controllers\TbproyectoController;
use App\Http\Controllers\TbcarreraController;
use App\Http\Controllers\TbgrupoController;
use App\Http\Controllers\TbtipousuarioController;
use App\Http\Controllers\TbareainvestigacionController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/consultar_todos_los_estudiantes', [TbestudianteController::class, 'index']);
Route::get('/consultar_estudiante/{id}', [TbestudianteController::class, 'show']);
Route::post('/crear_estudiante', [TbestudianteController::class, 'store']);
Route::patch('/actualizar_estudiante/{id}', [TbestudianteController::class, 'update']);
Route::delete('/eliminar_estudiante/{id}', [TbestudianteController::class, 'destroy']);


Route::get('/consultar_todos_los_tutores', [TbtutorController::class, 'index']);
Route::get('/consultar_tutor/{id}', [TbtutorController::class, 'show']);
Route::post('/crear_tutor', [TbtutorController::class, 'store']);
Route::patch('/actualizar_tutor/{id}', [TbtutorController::class, 'update']);
Route::delete('/eliminar_tutor/{id}', [TbtutorController::class, 'destroy']);

//Tipo Usuario
Route::get('/consultar_todos_los_usuarios', [TbusuariosController::class, 'index']);
Route::get('/consultar_usuario/{id}', [TbusuariosController::class, 'show']);
Route::post('/crear_usuario', [TbusuariosController::class, 'store']);
Route::patch('/actualizar_usuario/{id}', [TbusuariosController::class, 'update']);
Route::delete('/eliminar_usuario/{id}', [TbusuariosController::class, 'destroy']);

//Tipo proyecto
Route::get('/consultar_todos_los_proyectos', [TbproyectoController::class, 'index']);
Route::get('/consultar_proyecto/{id}', [TbproyectoController::class, 'show']);
Route::post('/crear_proyecto', [TbproyectoController::class, 'store']);
Route::patch('/actualizar_proyecto/{id}', [TbproyectoController::class, 'update']);
Route::delete('/eliminar_proyecto/{id}', [TbproyectoController::class, 'destroy']);

//Tabla carrera
Route::get('/consultar_todas_las_carreras', [TbcarreraController::class, 'index']);
Route::get('/consultar_carrera/{id}', [TbcarreraController::class, 'show']);
Route::post('/crear_carrera', [TbcarreraController::class, 'store']);
Route::patch('/actualizar_carrera/{id}', [TbcarreraController::class, 'update']);
Route::delete('/eliminar_carrera/{id}', [TbcarreraController::class, 'destroy']);

//Tabla grupo
Route::get('/consultar_todos_los_grupos', [TbgrupoController::class, 'index']);
Route::get('/consultar_grupo/{id}', [TbgrupoController::class, 'show']);
Route::post('/crear_grupo', [TbgrupoController::class, 'store']);
Route::patch('/actualizar_grupo/{id}', [TbgrupoController::class, 'update']);
Route::delete('/eliminar_grupo/{id}', [TbgrupoController::class, 'destroy']);

//Tabla tiposuario
Route::get('/consultar_todos_los_tipos_usuarios', [TbtipousuarioController::class, 'index']);
Route::get('/consultar_tipo_usuario/{id}', [TbtipousuarioController::class, 'show']);
Route::post('/crear_tipo_usuario', [TbtipousuarioController::class, 'store']);
Route::patch('/actualizar_tipo_usuario/{id}', [TbtipousuarioController::class, 'update']);
Route::delete('/eliminar_tipo_usuario/{id}', [TbtipousuarioController::class, 'destroy']);

//Tabla area investigacion
Route::get('/consultar_todas_las_areas_investigacion', [TbareainvestigacionController::class, 'index']);
Route::get('/consultar_area_investigacion/{id}', [TbareainvestigacionController::class, 'show']);
Route::post('/crear_area_investigacion', [TbareainvestigacionController::class, 'store']);
Route::patch('/actualizar_area_investigacion/{id}', [TbareainvestigacionController::class, 'update']);
Route::delete('/eliminar_area_investigacion/{id}', [TbareainvestigacionController::class, 'destroy']);





