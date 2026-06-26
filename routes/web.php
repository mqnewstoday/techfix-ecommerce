<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\CategoryManager;
use App\Livewire\ProductManager;
use App\Livewire\ServiceManager;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = \App\Models\Product::with('category')->inRandomOrder()->take(6)->get();
    return view('welcome', compact('products'));
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', \App\Livewire\UserProfile::class);
    Route::get('/katalog', \App\Livewire\UserCatalog::class);
    Route::get('/layanan', \App\Livewire\UserService::class);
    Route::get('/checkout/{id}', \App\Livewire\Checkout::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/categories');
    });

    Route::get('/categories', CategoryManager::class);
    Route::get('/products', ProductManager::class);
    Route::get('/services', ServiceManager::class);
    Route::get('/transactions', \App\Livewire\TransactionManager::class);
});
