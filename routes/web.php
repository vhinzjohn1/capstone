<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('web', 'auth')->name('dashboard');

Route::get('/dashboard', [GameController::class, 'showDashboard'])->name('dashboard');


Route::get('/game_screen_introduction', function () {
    return view('game_screen_introduction');
})->middleware('web', 'auth');

Route::get('/main_game', function () {
    return view('main_game');
})->middleware(['web', 'auth'])->name('main_game');


Route::get('/success', function () {
    return view('modals.success');
})->middleware(['web', 'auth'])->name('success');


Route::post('/update-progress', [GameController::class, 'updateProgress'])->middleware('web', 'auth')->name('update-progress');

// Use UserController for registration
Route::get('/signup', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/signup', [UserController::class, 'register'])->name('register.post');



Route::post('/logout', [UserController::class, 'logout'])->name('logout');

