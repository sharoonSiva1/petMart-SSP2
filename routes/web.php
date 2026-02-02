<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $neakasa = Product::where('name', 'like', '%Neakasa%')->first();
    return view('welcome', ['neakasa' => $neakasa]);
})->name('home');

Route::get('/shop/{pet}/{category}', function ($pet, $category) {
    return view('welcome', ['pet' => $pet, 'category' => $category]);
})->name('shop.filtered');

Route::get('/brand/{brand}', function ($brand) {
    return view('welcome', ['brand' => $brand]);
})->name('brand.show');

Route::get('/product/{product}', \App\Livewire\ProductDetail::class)->name('product.show');
Route::get('/cart', \App\Livewire\Cart::class)->name('cart.index');
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout.index');
Route::get('/about-us', \App\Livewire\AboutUs::class)->name('about');

// Auth
Route::get('/login', \App\Livewire\Login::class)->name('login');
Route::get('/register', \App\Livewire\Register::class)->name('register');
Route::get('/account', \App\Livewire\UserDashboard::class)->name('user.dashboard')->middleware('auth');
Route::get('/admin', \App\Livewire\AdminDashboard::class)->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::get('/logout', function () {
    auth()->logout();
    session()->invalidate();
    return redirect('/');
})->name('logout');