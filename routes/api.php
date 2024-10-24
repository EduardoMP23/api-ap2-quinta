<?php

use App\Http\Controllers\ControllerHeroi;
use App\Http\Controllers\ControllerVilao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::post('/Heroi', [ControllerHeroi::class, 'criar']);
Route::delete('/Heroi/{id}', [ControllerHeroi::class, 'deletar']);
Route::put('/Heroi/{id}', [ControllerHeroi::class, 'editar']);
Route::get('/Heroi/{id}', [ControllerHeroi::class, 'buscarPorId']);
Route::get('/Heroi', [ControllerHeroi::class, 'listarTodos']);

route::post('/Vilao', [ControllerVilao::class, 'criar']);
Route::delete('/Vilao/{id}', [ControllerVilao::class, 'deletar']);
Route::put('/Vilao/{id}', [ControllerVilao::class, 'editar']);
Route::get('/Vilao/{id}', [ControllerVilao::class, 'buscarPorId']);
Route::get('/Vilao', [ControllerVilao::class, 'listarTodos']);
