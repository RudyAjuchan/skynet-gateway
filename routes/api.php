<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EventoVisitaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\TecnicosController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/visitas', [VisitaController::class, 'index']);
});


// Solo supervisor
Route::middleware(['auth:sanctum', 'rol:Supervisor'])->group(function () {
    //Route::post('/visitas', [VisitaController::class, 'store']);

    Route::post('/visitas', [VisitaController::class, 'store']);
    Route::put('/visitas/{id}', [VisitaController::class, 'update']);
    Route::delete('/visitas/{id}', [VisitaController::class, 'destroy']);

    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    Route::get('/tecnicos', [TecnicosController::class, 'index']);
    Route::post('/tecnicos', [TecnicosController::class, 'store']);
    Route::put('/tecnicos/{id}', [TecnicosController::class, 'update']);
    Route::delete('/tecnicos/{id}', [TecnicosController::class, 'destroy']);

});

Route::get('/reporte/{id}', [ReporteController::class, 'generarPDF']);
Route::post('/reporte/enviar/{id}', [ReporteController::class, 'enviarReporte']);


// Solo técnico
Route::middleware(['auth:sanctum', 'rol:Tecnico'])->group(function () {
    Route::post('/visitasT/{id}/eventos', [EventoVisitaController::class, 'registrarEvento']);
    Route::put('/visitasT/{id}/finalizar', [EventoVisitaController::class, 'finalizarVisita']);
});
