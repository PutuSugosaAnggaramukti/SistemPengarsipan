<?php

use App\Http\Controllers\DaftarBerkasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ViewPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//  Route::get('/documents', [DaftarBerkasController::class, 'index'])->name('documents.index');
// Route::get('/view', [ViewPageController::class, 'indexview'])->name('view');

Route::resource('documents', DocumentController::class);
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
// Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

Route::get('/view-pdf/{id}', function ($id) {
    return view('indexview', ['id' => $id]);
});



