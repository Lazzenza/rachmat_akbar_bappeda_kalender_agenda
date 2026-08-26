<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

Route::get('/', function () {
    return view('welcome');





























    });

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/kalender', function () {
    return view('agenda');
})->name('kalender.index');