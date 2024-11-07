<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');

        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');

        Route::prefix('{category}')->group(function () {
            Route::get('/show', [CategoryController::class, 'show'])->name('categories.show');
            Route::get('/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/', [CategoryController::class, 'destroy'])->name('categories.delete');
        });
    });
});

require __DIR__.'/auth.php';
