<?php

use App\Http\Controllers\DaftarBerkasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ViewPageController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//  Route::get('/documents', [DaftarBerkasController::class, 'index'])->name('documents.index');
Route::get('/view', [ViewPageController::class, 'indexview'])->name('view');
Route::get('/daftarberkas', [FileController::class, 'indexdaftarberkas'])->name('files.indexdaftarberkas');
Route::get('/files/{id}/show', [FileController::class, 'show'])->name('files.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])
    ->name('files.index');

Route::get('/files2020', [App\Http\Controllers\FileController::class, 'index2020'])
    ->name('files.index2020');

Route::get('/files/create', [App\Http\Controllers\FileController::class, 'create'])
    ->name('files.create');

Route::post('/files/store', [App\Http\Controllers\FileController::class, 'store'])
    ->name('files.store');

Route::get('/files/{file}/download', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download');

// Route::get('/files/{file}/delete', [App\Http\Controllers\FileController::class, 'destroy'])
//     ->name('files.delete');

Route::delete('/documents/{id}', [FileController::class, 'destroy'])->name('files.destroy');


// Show the login form
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


