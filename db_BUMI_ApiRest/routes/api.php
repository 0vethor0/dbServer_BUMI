<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TbestudianteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/estudiantes', [TbestudianteController::class, 'index']);
Route::get('/estudiantes/{id}', [TbestudianteController::class, 'show']);
Route::post('/estudiantes', [TbestudianteController::class, 'store']);
Route::patch('/estudiantes/{id}', [TbestudianteController::class, 'update']);
Route::delete('/estudiantes/{id}', [TbestudianteController::class, 'destroy']);


