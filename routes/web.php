<?php

use App\Http\Controllers\DaftarBerkasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileController2020;
use App\Http\Controllers\FileController2021;
use App\Http\Controllers\FileController2022;
use App\Http\Controllers\FileController2023;
use App\Http\Controllers\FileController2024;
use App\Http\Controllers\FileController2025;
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

Route::post('/files/{id}/restore', [FileController::class, 'restore2019'])->name('files.restore2019');
Route::post('/files/restoreallfiles', [FileController::class, 'restoreAllFiles'])->name('files.restoreAllFiles');

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
Route::post('/files/{id}/restore', [FileController2020::class, 'restore2020'])->name('files.restore2020');
Route::post('/files/restoreall2020', [FileController2020::class, 'restoreAll2020'])->name('files.restoreAll2020');


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
Route::post('/files/{id}/restore', [FileController2021::class, 'restore2021'])->name('files.restore2021');
Route::post('/files/restoreall2021', [FileController2021::class, 'restoreAll2021'])->name('files.restoreAll2021');


//ROUTE BERKAS 2022
Route::get('/files2022', [App\Http\Controllers\FileController2022::class, 'index2022'])
    ->name('files.index2022');

Route::get('/files/create2022', [App\Http\Controllers\FileController2022::class, 'create'])
    ->name('files.create2022');

Route::post('/files/store2022', [App\Http\Controllers\FileController2022::class, 'store2022'])
    ->name('files.store2022');

Route::post('/files/{id}/restore', [FileController2022::class, 'restore2022'])->name('files.restore2022');
Route::post('/files/restore-all', [FileController2022::class, 'restoreAll'])->name('files.restoreAll');

Route::get('/files2022/{file}/download', [App\Http\Controllers\FileController2022::class, 'download2022'])
    ->name('files.download2022');

Route::get('/files/{id}/show2022', [FileController2022::class, 'show2022'])->name('files.show2022');

Route::delete('/documents2022/{id}', [FileController2022::class, 'destroy2022'])->name('files.destroy2022');

//ROUTE BERKAS 2023
Route::get('/files2023', [App\Http\Controllers\FileController2023::class, 'index2023'])
    ->name('files.index2023');

Route::get('/files/create2023', [App\Http\Controllers\FileController2023::class, 'create'])
    ->name('files.create2023');

Route::post('/files/store2023', [App\Http\Controllers\FileController2023::class, 'store2023'])
    ->name('files.store2023');

Route::get('/files2023/{file}/download', [App\Http\Controllers\FileController2023::class, 'download2023'])
    ->name('files.download2023');

Route::get('/files/{id}/show2023', [FileController2023::class, 'show2023'])->name('files.show2023');

Route::delete('/documents2023/{id}', [FileController2023::class, 'destroy2023'])->name('files.destroy2023');
Route::post('/files/{id}/restore', [FileController2023::class, 'restore2023'])->name('files.restore2023');
Route::post('/files/restoreall2023', [FileController2023::class, 'restoreAll2023'])->name('files.restoreAll2023');


//ROUTE BERKAS 2024
Route::get('/files2024', [App\Http\Controllers\FileController2024::class, 'index2024'])
    ->name('files.index2024');

Route::get('/files/create2024', [App\Http\Controllers\FileController2024::class, 'create'])
    ->name('files.create2024');

Route::post('/files/store2024', [App\Http\Controllers\FileController2024::class, 'store2024'])
    ->name('files.store2024');

Route::get('/files2024/{file}/download', [App\Http\Controllers\FileController2024::class, 'download2024'])
    ->name('files.download2024');

Route::get('/files/{id}/show2024', [FileController2024::class, 'show2024'])->name('files.show2024');

Route::delete('/documents2024/{id}', [FileController2024::class, 'destroy2024'])->name('files.destroy2024');
Route::post('/files/{id}/restore', [FileController2024::class, 'restore2024'])->name('files.restore2024');
Route::post('/files/restoreall2024', [FileController2024::class, 'restoreAll2024'])->name('files.restoreAll2024');



//ROUTE DASHBOARD 2025
Route::get('/files2025', [App\Http\Controllers\FileController2025::class, 'index2025'])
    ->name('files.index2025');

Route::get('/files/create2025', [App\Http\Controllers\FileController2025::class, 'create'])
    ->name('files.create2025');

Route::post('/files/store2025', [App\Http\Controllers\FileController2025::class, 'store2025'])
    ->name('files.store2025');

Route::get('/files2025/{file}/download', [App\Http\Controllers\FileController2025::class, 'download2025'])
    ->name('files.download2025');

Route::get('/files/{id}/show2025', [FileController2025::class, 'show2025'])->name('files.show2025');

Route::delete('/documents2025/{id}', [FileController2025::class, 'destroy2025'])->name('files.destroy2025');
Route::post('/files/{id}/restore', [FileController2025::class, 'restore2025'])->name('files.restore2025');
Route::post('/files/restoreall2025', [FileController2025::class, 'restoreAll2025'])->name('files.restoreAll2025');


// Show the login form
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


