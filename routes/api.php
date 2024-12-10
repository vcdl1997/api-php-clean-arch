<?php

use App\Application\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::prefix('usuarios')->group(function () {
    Route::get('', [UsuarioController::class, 'search']);
    Route::get('/{id}', [UsuarioController::class, 'findBy']);
    Route::post('', [UsuarioController::class, 'create']);
    Route::put('/{id}', [UsuarioController::class, 'update']);
    Route::delete('/{id}', [UsuarioController::class, 'delete']);
});
