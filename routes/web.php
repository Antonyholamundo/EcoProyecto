<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReporteController;

Route::get('/lo

gin', function () {
    return view('logica.login');
});


// Usar el resource completo
Route::resource('citas', CitaController::class)
    ->names([
        'index' => 'logica.citas',
    ]);
Route::resource('pacientes', PacienteController::class)
    ->names([
        'index' => 'logica.pacientes',
    ]);

    Route::get('/', function () {
    return view('logica.index'); 
});

Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/pacientes/pdf', [ReporteController::class, 'pacientesPdf'])->name('reportes.pacientes.pdf');
Route::get('/reportes/pacientes/excel', [ReporteController::class, 'pacientesExcel'])->name('reportes.pacientes.excel');
Route::get('/reportes/pacientes/csv', [ReporteController::class, 'pacientesCsv'])->name('reportes.pacientes.csv');

