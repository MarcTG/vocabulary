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

Route::prefix('/categories')->group(function (){
    Route::get('', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('', [CategoryController::class, 'store']);
    Route::post('/update', [CategoryController::class, 'update']);
    Route::delete('', [CategoryController::class, 'delete']);
});


Route::post('/category/word', [CategoryWordController::class, 'store']);
Route::delete('/category/word/{categoryWord}', [CategoryWordController::class, 'delete']);

Route::get('/words', [WordController::class, 'index']);
Route::get('/words/{word}', [WordController::class, 'show']);

