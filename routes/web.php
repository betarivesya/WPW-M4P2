<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route menampilkan form
Route::get('/upload', function () {
    return view('upload');
})->name('upload.form');

// Route memproses file upload
Route::post('/upload', [BookController::class, 'upload'])->name('file.upload');

Route::get('/laporan-pdf', [LaporanController::class, 'generatePDF']);
