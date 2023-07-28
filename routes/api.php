<?php

use App\Http\Controllers\FaixaController;
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
Route::resource('katas', KataController::class)->except([
    'create', 'edit'
]);
