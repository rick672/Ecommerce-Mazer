<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('auth');

Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');
