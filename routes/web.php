<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberConverter;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view_number_converter', [NumberConverter::class, 'view_number_converter'])->name('view_number_converter');
Route::post('/convert', [NumberConverter::class, 'convert'])->name('convert');