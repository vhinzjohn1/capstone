<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/space_game/index.html', function () {
    return redirect('/space_game/index.html');
})->name('space_game');




Route::get('/leaderboard-data', [GameController::class, 'getLeaderboardData'])->name('leaderboard.data');


// User registration routes
Route::get('/signup', [UserController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [UserController::class, 'register'])->name('register.post');

// User login routes
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.post');

// Authenticated routes
Route::middleware(['web', 'auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [GameController::class, 'showDashboard'])->name('dashboard');

    // Success modal route
    Route::get('/success', function () {
        return view('modals.success');
    })->name('success');

    // Update progress route
    Route::post('/update-progress', [GameController::class, 'updateProgress'])->name('update-progress');

    // User logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Stages routes
    Route::get('/stages/{id}', function ($id) {
        $maxStages = 12;
        $viewPrefix = 'stages.stage';

        if ($id >= 1 && $id <= $maxStages) {
            $viewName = $id === 1 ? 'introduction' : $viewPrefix . ($id - 1);
            return view($viewName, ['stageId' => $id]);
        } else {
            return abort(404);
        }
    })->name('stage');
});
