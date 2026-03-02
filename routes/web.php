<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;

// Públicas
Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protegidas
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function() { 
        return redirect('/pacientes');
    })->name('dashboard')->middleware('auth');

    // Pacientes con permisos
    Route::get('/pacientes',          [PacienteController::class, 'index'])  ->middleware('permission:ver_pacientes');
    Route::get('/pacientes/create',   [PacienteController::class, 'create']) ->middleware('permission:crear_pacientes');
    Route::post('/pacientes',         [PacienteController::class, 'store'])  ->middleware('permission:crear_pacientes');
    Route::get('/pacientes/{id}',     [PacienteController::class, 'show'])   ->middleware('permission:ver_pacientes');
    Route::get('/pacientes/{id}/edit',[PacienteController::class, 'edit'])   ->middleware('permission:editar_pacientes');
    Route::put('/pacientes/{id}',     [PacienteController::class, 'update']) ->middleware('permission:editar_pacientes');
    Route::delete('/pacientes/{id}',  [PacienteController::class, 'destroy'])->middleware('permission:eliminar_pacientes');
});


