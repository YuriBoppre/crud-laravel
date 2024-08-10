<?php

use App\Http\Controllers\ConsultoreController;
use App\Http\Controllers\CompromissoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('consultores', ConsultoreController::class);
Route::resource('compromissos', CompromissoController::class);