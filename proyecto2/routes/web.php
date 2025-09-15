<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatriculasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola/{mensaje}', function($mensaje) {
    return view('hola', ['mensaje' => $mensaje]);
});

Route::resource('matriculas',MatriculasController::class);

