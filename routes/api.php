<?php

use App\Application\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->group(function () {
    Route::get('', [UsuarioController::class, 'search'])->name('usuario.search');
    Route::get('/{id}', [UsuarioController::class, 'findBy'])->name('usuario.findBy');
    Route::post('', [UsuarioController::class, 'create'])->middleware('enableTransaction');
    Route::put('/{id}', [UsuarioController::class, 'update'])->middleware('enableTransaction');
    Route::delete('/{id}', [UsuarioController::class, 'delete'])->middleware('enableTransaction');
});
