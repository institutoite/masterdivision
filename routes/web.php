<?php

use App\Http\Controllers\DivisionPdfController;
use App\Http\Controllers\PaymentProofController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PaymentApprovalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DivisionPdfController::class, 'index'])
    ->middleware(['auth', 'paid'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('/registro-exitoso', 'auth.register-success')->name('register.success');
    Route::view('/verificacion', 'auth.verification-pending')->name('verification.pending');
    Route::post('/comprobante', [PaymentProofController::class, 'store'])->name('payment.proof.store');
});

Route::middleware(['auth', 'paid'])->group(function () {
    Route::post('/generar', [DivisionPdfController::class, 'generate'])->name('division.generate');
    Route::post('/generar-examen', [DivisionPdfController::class, 'generateExam'])->name('division.exam');
    Route::post('/generar-todos', [DivisionPdfController::class, 'generateAll'])->name('division.generate.all');
    Route::post('/generar-diagnostico', [DivisionPdfController::class, 'generateDiagnostic'])->name('division.diagnostic');
    Route::get('/historial/{history}', [DivisionPdfController::class, 'download'])->name('division.download');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pagos', [PaymentApprovalController::class, 'index'])->name('admin.payments.index');
    Route::post('/admin/pagos/{user}/aprobar', [PaymentApprovalController::class, 'approve'])->name('admin.payments.approve');
    Route::post('/admin/pagos/{user}/revocar', [PaymentApprovalController::class, 'revoke'])->name('admin.payments.revoke');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
