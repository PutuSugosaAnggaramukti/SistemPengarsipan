<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBerkasController;
use App\Http\Controllers\ViewPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//Route::get('/daftar', [DaftarBerkasController::class, 'daftarberkaspage'])->name('daftar');
Route::get('/view', [ViewPageController::class, 'indexview'])->name('view');

Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])
    ->name('files.index');

Route::post('/files/create', [App\Http\Controllers\FileController::class, 'create'])
    ->name('files.create');

Route::post('/files/store', [App\Http\Controllers\FileController::class, 'store'])
    ->name('files.store');

Route::get('/files/{file}/download', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download');