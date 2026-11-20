<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Protected Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/meals/{meal}/edit', [MealController::class, 'edit'])->name('meals.edit');
    Route::put('/meals/{meal}', [MealController::class, 'update'])->name('meals.update');
    Route::get('/checkout', function () {
    session()->forget('cart');
    return redirect()->route('home')->with('success', 'Order placed successfully! Thank you.');
})->name('checkout');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
    Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
    Route::delete('/meals/{meal}', [MealController::class, 'destroy'])->name('meals.destroy');
});

require __DIR__.'/auth.php';