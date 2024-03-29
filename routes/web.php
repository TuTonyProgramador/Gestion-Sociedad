<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\CriadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CanarioController;
use App\Http\Controllers\ConcursoController;

// Ruta del index de la aplicacion 
Route::get('/', [LayoutController::class, 'inicioCriador'])->name('layout.inicioCriador'); 
Route::get('/logout', [LayoutController::class, 'logout'])->name('layout.logout');
Route::get('/layout/olvidoPwd', [LayoutController::class, 'olvido'])->name('layout.olvido'); 

// Rutas para el inicio de sesion
Route::get('/criador/sesionCriador', [CriadorController::class, 'sesionC'])->name('criador.sesionC'); 
Route::post('/criador/login', [CriadorController::class, 'login'])->name('criador.login');
Route::get('/criador/menuOpcion', [CriadorController::class, 'menu'])->name('criador.menu')->middleware('auth');

// Rutas del criador 
Route::get('/criador/createCriador', [CriadorController::class, 'create'])->name('criador.create');
Route::post('/criador/store', [CriadorController::class, 'store'])->name('criador.store');
Route::get('/criador/showCriador', [CriadorController::class, 'showC'])->name('criador.showC')->middleware('auth');
Route::get('/criador/showCriadorLectura', [CriadorController::class, 'showCL'])->name('criador.showCL')->middleware('auth');
Route::get('/criador/edit{criador}', [CriadorController::class, 'edit'])->name('criador.edit')->middleware('auth');
Route::put('/criador/update/{criador}', [CriadorController::class, 'update'])->name('criador.update')->middleware('auth');
Route::delete('/criador/destroy/{criador}', [CriadorController::class, 'destroy'])->name('criador.destroy')->middleware('auth');

// Rutas del canario 
Route::get('/canario/createCanario', [CanarioController::class, 'create'])->name('canario.create')->middleware('auth');
Route::post('/canario/store', [CanarioController::class, 'store'])->name('canario.store')->middleware('auth');
Route::get('/canario/showCanario', [CanarioController::class, 'showCan'])->name('canario.showCan')->middleware('auth');
Route::get('/canario/showCanarioAdmin', [CanarioController::class, 'showCanA'])->name('canario.showCanA')->middleware('auth');
Route::get('/canario/edit{canario}', [CanarioController::class, 'edit'])->name('canario.edit')->middleware('auth');
Route::put('/canario/update/{canario}', [CanarioController::class, 'update'])->name('canario.update')->middleware('auth');
Route::delete('/canario/destroy/{canario}', [CanarioController::class, 'destroy'])->name('canario.destroy')->middleware('auth');

// Rutas de los concursos
Route::get('/concurso/showConcursoLectura', [ConcursoController::class, 'showConL'])->name('concurso.showConL')->middleware('auth');
Route::get('/concurso/createConcurso', [ConcursoController::class, 'create'])->name('concurso.create')->middleware('auth');
Route::post('/concurso/store', [ConcursoController::class, 'store'])->name('concurso.store')->middleware('auth');
Route::get('/concurso/showConcurso', [ConcursoController::class, 'showCon'])->name('concurso.showCon')->middleware('auth');
Route::get('/concurso/edit{concurso}', [ConcursoController::class, 'edit'])->name('concurso.edit')->middleware('auth');
Route::put('/concurso/update/{concurso}', [ConcursoController::class, 'update'])->name('concurso.update')->middleware('auth');
Route::delete('/concurso/destroy/{concurso}', [ConcursoController::class, 'destroy'])->name('concurso.destroy')->middleware('auth');