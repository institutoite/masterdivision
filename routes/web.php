<?php

use App\Http\Controllers\DivisionPdfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DivisionPdfController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/generar', [DivisionPdfController::class, 'generate'])->name('division.generate');
    Route::post('/generar-examen', [DivisionPdfController::class, 'generateExam'])->name('division.exam');
    Route::post('/generar-todos', [DivisionPdfController::class, 'generateAll'])->name('division.generate.all');
    Route::post('/generar-diagnostico', [DivisionPdfController::class, 'generateDiagnostic'])->name('division.diagnostic');
    Route::get('/historial/{history}', [DivisionPdfController::class, 'download'])->name('division.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
