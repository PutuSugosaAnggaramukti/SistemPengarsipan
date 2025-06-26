<?php

use App\Http\Controllers\DaftarBerkasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileController2020;
use App\Http\Controllers\FileController2021; 
use App\Http\Controllers\DashboardController2020;
use App\Http\Controllers\ViewPageController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//  Route::get('/documents', [DaftarBerkasController::class, 'index'])->name('documents.index');
Route::get('/view', [ViewPageController::class, 'indexview'])->name('view');
Route::get('/daftarberkas', [FileController::class, 'indexdaftarberkas'])->name('files.indexdaftarberkas');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

//ROUTE BERKAS 2019
Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])
    ->name('files.index');

Route::get('/files/create', [App\Http\Controllers\FileController::class, 'create'])
    ->name('files.create');

Route::post('/files/store', [App\Http\Controllers\FileController::class, 'store'])
    ->name('files.store');

Route::get('/files/{file}/download', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download');

Route::get('/files/{id}/show', [FileController::class, 'show'])->name('files.show');

Route::delete('/documents/{id}', [FileController::class, 'destroy'])->name('files.destroy');

//ROUTE BERKAS 2020
Route::get('/files2020', [App\Http\Controllers\FileController2020::class, 'index2020'])
    ->name('files.index2020');

Route::get('/files/create2020', [App\Http\Controllers\FileController2020::class, 'create'])
    ->name('files.create2020');

Route::post('/files/store2020', [App\Http\Controllers\FileController2020::class, 'store2020'])
    ->name('files.store2020');

Route::get('/files2020/{file}/download', [App\Http\Controllers\FileController2020::class, 'download2020'])
    ->name('files.download2020');

Route::get('/files/{id}/show2020', [FileController2020::class, 'show2020'])->name('files.show2020');

Route::delete('/documents2020/{id}', [FileController2020::class, 'destroy2020'])->name('files.destroy2020');

//ROUTE BERKAS 2021
Route::get('/files2021', [App\Http\Controllers\FileController2021::class, 'index2021'])
    ->name('files.index2021');

Route::get('/files/create2021', [App\Http\Controllers\FileController2021::class, 'create'])
    ->name('files.create2021');

Route::post('/files/store2021', [App\Http\Controllers\FileController2021::class, 'store2021'])
    ->name('files.store2021');

Route::get('/files2021/{file}/download', [App\Http\Controllers\FileController2021::class, 'download2021'])
    ->name('files.download2021');

Route::get('/files/{id}/show2021', [FileController2021::class, 'show2021'])->name('files.show2021');

Route::delete('/documents2021/{id}', [FileController2021::class, 'destroy2021'])->name('files.destroy2021');


// Route::get('/files/{file}/delete', [App\Http\Controllers\FileController::class, 'destroy'])
//     ->name('files.delete');






// Show the login form
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


