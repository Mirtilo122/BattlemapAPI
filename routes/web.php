<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonagemController;
use App\Http\Controllers\MonstroController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\BattlemapController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas que precisa estar logado mas não precisa ser dm

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::resource('personagens', PersonagemController::class);



    Route::prefix('battlemap')->group(function() {
        Route::get('{mapaId}/{quartoId?}', [BattlemapController::class, 'index'])->name('battlemap.index');
        Route::post('mover/{entidade}', [BattlemapController::class, 'mover'])->name('battlemap.mover');
    });

});




// Rotas que precisa ser dm
Route::middleware(['auth', 'dm'])->group(function () {
    Route::resource('users', UserController::class);

    Route::resource('monstros', MonstroController::class);

    Route::resource('mapas', MapaController::class);
    Route::post('mapas/{mapa}/vincular-usuarios', [MapaController::class, 'vincularUsuarios'])
        ->name('mapas.vincularUsuarios');


    Route::prefix('mapas/{mapaId}')->group(function () {
        // Quartos
        Route::resource('quartos', QuartoController::class)
        ->except(['show']);

        // Portas (modals dentro do edit/create de quartos)
        Route::post('quartos/{quarto}/portas', [QuartoController::class, 'storePorta'])->name('portas.store');
        Route::put('portas/{porta}', [QuartoController::class, 'updatePorta'])->name('portas.update');
        Route::delete('portas/{porta}', [QuartoController::class, 'destroyPorta'])->name('portas.destroy');
    });

    Route::prefix('battlemap')->group(function() {
        Route::post('porta/{porta}/trancar', [BattlemapController::class, 'trancarPorta'])->name('battlemap.trancarPorta');
    });
});
