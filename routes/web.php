<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\CriadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CanarioController;
use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\GraficoController;

// Ruta del index de la aplicacion 
Route::get('/', [LayoutController::class, 'inicioCriador'])->name('layout.inicioCriador'); 
Route::get('/logout', [LayoutController::class, 'logout'])->name('layout.logout');
Route::get('/layout/olvidoPwd', [LayoutController::class, 'olvido'])->name('layout.olvido'); 
Route::post('/layout/enviarLinkRecuperacion', [LayoutController::class, 'enviarLinkRecuperacion'])->name('layout.enviarLinkRecuperacion');

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
Route::get('/criador/search', [CriadorController::class, 'search'])->name('criador.search')->middleware('auth');
Route::get('criador/formularioCorreo', [CriadorController::class, 'formularioCorreo'])->name('criador.formularioCorreo')->middleware('auth');
Route::post('criador/enviaCcorreo', [CriadorController::class, 'enviarCorreo'])->name('criador.enviarCorreo')->middleware('auth');

// Rutas del canario 
Route::get('/canario/createCanario', [CanarioController::class, 'create'])->name('canario.create')->middleware('auth');
Route::post('/canario/store', [CanarioController::class, 'store'])->name('canario.store')->middleware('auth');
Route::get('/canario/showCanarioAdmin', [CanarioController::class, 'showCanA'])->name('canario.showCanA')->middleware('auth');
Route::get('/canario/edit{canario}', [CanarioController::class, 'edit'])->name('canario.edit')->middleware('auth');
Route::put('/canario/update/{canario}', [CanarioController::class, 'update'])->name('canario.update')->middleware('auth');
Route::get('/canario/seleccionarC/{canario}', [CanarioController::class, 'seleccionarCEdit'])->name('canario.seleccionarCEdit')->middleware('auth');
Route::put('/canario/seleccionarC/{canario}', [CanarioController::class, 'seleccionarCUpdate'])->name('canario.seleccionarCUpdate')->middleware('auth');
Route::delete('/canario/destroy/{canario}', [CanarioController::class, 'destroy'])->name('canario.destroy')->middleware('auth');
Route::get('/graficos/graficoCanarios', [GraficoController::class, 'graficoCanarios'])->name('graficos.graficoCanarios')->middleware('auth');
Route::get('/canario/search', [CanarioController::class, 'search'])->name('canario.search')->middleware('auth');

// Rutas de los concursos
Route::get('/concurso/showConcursoLectura', [ConcursoController::class, 'showConL'])->name('concurso.showConL')->middleware('auth');
Route::get('/concurso/createConcurso', [ConcursoController::class, 'create'])->name('concurso.create')->middleware('auth');
Route::post('/concurso/store', [ConcursoController::class, 'store'])->name('concurso.store')->middleware('auth');
Route::get('/concurso/showConcurso', [ConcursoController::class, 'showCon'])->name('concurso.showCon')->middleware('auth');
Route::get('/concurso/edit{concurso}', [ConcursoController::class, 'edit'])->name('concurso.edit')->middleware('auth');
Route::put('/concurso/update/{concurso}', [ConcursoController::class, 'update'])->name('concurso.update')->middleware('auth');
Route::delete('/concurso/destroy/{concurso}', [ConcursoController::class, 'destroy'])->name('concurso.destroy')->middleware('auth');
Route::get('/concurso/canariosConcurso/{concurso}', [ConcursoController::class, 'canariosConcurso'])->name('concurso.canariosConcurso')->middleware('auth');
Route::get('/concurso/canariosCriador', [ConcursoController::class, 'canariosCriador'])->name('concurso.canariosCriador')->middleware('auth');