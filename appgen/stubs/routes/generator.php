<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MLabGeneratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('mlab-generator', [MLabGeneratorController::class, 'index'])->name('generator.index');
Route::get('crud-manager', [MLabGeneratorController::class, 'crudManager'])->name('generator.crud');
Route::get('user-manager', [MLabGeneratorController::class, 'userManager'])->name('generator.user');
Route::get('user-manager', [MLabGeneratorController::class, 'crudmanGenerateModel'])->name('generator.createModel');