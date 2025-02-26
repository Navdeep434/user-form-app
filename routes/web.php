<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserFormController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserFormController::class, 'index'])->name('user.index');
Route::post('/store', [UserFormController::class, 'store'])->name('user.store');
Route::get('/export-all', [UserFormController::class, 'exportCsv'])->name('user.exportAll');
Route::get('/export-current', [UserFormController::class, 'exportCurrentUser'])->name('user.exportCurrent'); // Changed from POST to GET
Route::post('/delete/{id}', [UserFormController::class, 'destroy'])->name('user.destroy');
