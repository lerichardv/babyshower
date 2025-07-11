<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\WishlistManager;
use App\Http\Livewire\WishlistDisplay;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/wishlist', WishlistDisplay::class)->name('wishlist');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', WishlistManager::class)->name('dashboard');
});

require __DIR__.'/auth.php';
