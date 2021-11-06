<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [ArticlesController::class, 'index'])->name('articles.index');
Route::middleware(['auth'])->group(function () {
    
    Route::resource('articles', ArticlesController::class)->except('index') ;
    Route::post('/articles/store', [ArticlesController::class, 'store'])->name('articles.store') ;
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
