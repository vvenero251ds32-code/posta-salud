<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PersonalMedicoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('pacientes', PacienteController::class);

Route::resource('personal-medico', PersonalMedicoController::class)
    ->parameters(['personal-medico' => 'personalMedico'])
    ->except(['destroy']);

Route::patch('personal-medico/{personalMedico}/estado',
    [PersonalMedicoController::class, 'cambiarEstado'])
    ->name('personal-medico.estado');