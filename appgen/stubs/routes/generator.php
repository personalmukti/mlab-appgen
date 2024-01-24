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

// Main Routes
Route::get('mlab-generator', [MLabGeneratorController::class, 'index'])->name('generator.index');
Route::get('crud-manager', [MLabGeneratorController::class, 'crudManager'])->name('generator.crud');
Route::get('user-manager', [MLabGeneratorController::class, 'userManager'])->name('generator.user');

// Helper Routes
Route::post('setup-app', [MLabGeneratorController::class, 'crudmanGenerateModel'])->name('generator.createModel');