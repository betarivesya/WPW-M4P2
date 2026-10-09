<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Tambahkan route api disini
use App\Http\Controllers\Api\BookController;
Route::apiResource('books', BookController::class);