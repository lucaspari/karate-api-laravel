<?php

use App\Http\Controllers\FaixaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::get('/faixas',[FaixaController::class,'index'])->name('faixa.index');
Route::get('/faixas/save',[FaixaController::class,'store'])->name('faixa.store');
