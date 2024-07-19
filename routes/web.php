<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;


Route::get('/', function () {
    return redirect('/records');
});

Route::resource('records', RecordController::class);

Route::get('/records', [RecordController::class, 'index'])->name('records.index');
Route::post('/upload', [RecordController::class, 'upload'])->name('upload');
