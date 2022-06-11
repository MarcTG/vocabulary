<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\CategoryWordController;
use App\Http\Controllers\WordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return Inertia::render('Home');
});

Route::prefix('/categories')->group(function() {
    Route::get('', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('', [CategoryController::class, 'store']);
    Route::post('/update', [CategoryController::class, 'update']);
    Route::delete('', [CategoryController::class, 'delete']);
});

Route::prefix('/category/word')->group(function() {
    Route::post('', [CategoryWordController::class, 'store']);
    Route::delete('', [CategoryWordController::class, 'delete']);
});

Route::prefix('/words')->group(function () {
    Route::get('/', [WordController::class, 'index']);
/*    Route::get('/words/{word}', [WordController::class, 'show']);*/
    Route::delete('', [WordController::class, 'delete']);
});



