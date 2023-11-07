<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');


Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::get('/dashboard', [GameController::class, 'showDashboard'])->middleware(['web', 'auth'])->name('dashboard');


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

Route::get('/stages/{id}', function ($id) {
    // Load the Blade template based on the stage ID
    return view("stages.stage$id", ['stageId' => $id]);
})->middleware(['web', 'auth'])->name('stage');


