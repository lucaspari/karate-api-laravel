<?php

use App\Http\Controllers\FaixaController;
use App\Http\Controllers\GolpeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KataController;
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

Route::resource('faixas', FaixaController::class)->except([
    'create', 'edit'
]);
Route::get('katas', [KataController::class, 'index'])->name('kata.index');
Route::get('katas/{faixaId}', [KataController::class, 'findKataByFaixaId'])->name("kata.findByFaixaId");
Route::get("golpes", [GolpeController::class, 'index'])->name("golpe.index");
Route::get("golpes/{faixaId}", [GolpeController::class, 'findGolpesByFaixa'])
    ->name("golpe.findGolpesByFaixa");

