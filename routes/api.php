<?php

use App\Http\Controllers\FaixaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/faixas', [FaixaController::class, 'index'])->name('faixa.index');
Route::post('/faixas/create', [FaixaController::class, 'store'])->name('faixa.store');
Route::get("/faixas/{id}", [FaixaController::class, 'show'])->name('faixa.show');
Route::put("/faixas/{id}", [FaixaController::class, 'update'])->name('faixa.update');
Route::delete("/faixas/{id}", [FaixaController::class, 'destroy'])->name('faixa.destroy');
