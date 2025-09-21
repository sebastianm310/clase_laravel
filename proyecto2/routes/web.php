<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\FotogrametriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola/{mensaje}', function($mensaje) {
    return view('hola', ['mensaje' => $mensaje]);
});

Route::resource('matriculas',MatriculasController::class);

Route::get('/fotogrametria', [FotogrametriaController::class, 'index'])->name('fotogrametria.index');
Route::post('/fotogrametria', [FotogrametriaController::class,'store'])->name('fotogrametria.store');

