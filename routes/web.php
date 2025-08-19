<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\UserController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Modules
    Route::resource('modules', ModuleController::class)->except(['show']);
    Route::get('modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
    Route::post('modules/{module}/complete', [ModuleController::class, 'complete'])->name('modules.complete');
    
    // Quiz
    Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
        Route::post('/{quiz}/submit', [QuizController::class, 'submit'])->name('submit');
    });
    
    // Assignments
    Route::prefix('assignments')->name('assignments.')->group(function () {
        Route::get('/{assignment}', [AssignmentController::class, 'show'])->name('show');
        Route::post('/{assignment}/submit', [AssignmentController::class, 'submit'])->name('submit');
    });
    
    // Profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('show');
        Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
        Route::put('/password', [UserController::class, 'updatePassword'])->name('password');
    });
});
