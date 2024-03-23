<?php

use Livewire\Volt\Volt;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Home;
use Illuminate\Support\Facades\Auth;

// Volt::route('/', 'users.index');
Route::get('/', Login::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/home', Home::class)->name('home')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->to('/login');
})->name('logout');

