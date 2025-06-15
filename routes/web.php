<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBerkasController;
use App\Http\Controllers\ViewPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/daftar', [DaftarBerkasController::class, 'daftarberkaspage'])->name('daftar');
Route::get('/view', [ViewPageController::class, 'indexview'])->name('view');
