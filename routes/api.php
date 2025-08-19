<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuizController;

Route::middleware('auth:sanctum')->group(function () {
    
    // API pour récupérer les informations utilisateur
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // API pour la progression des modules
    Route::prefix('modules')->group(function () {
        Route::get('/', [ModuleController::class, 'index']);
        Route::get('/{module}', [ModuleController::class, 'show']);
        Route::post('/{module}/complete', [ModuleController::class, 'complete']);
    });
    
    // API pour les quiz
    Route::prefix('quizzes')->group(function () {
        Route::get('/{quiz}', [QuizController::class, 'show']);
        Route::post('/{quiz}/submit', [QuizController::class, 'submit']);
    });
    
    // API pour récupérer les statistiques de progression
    Route::get('/stats', function (Request $request) {
        $user = $request->user();
        $progressService = new \App\Services\ProgressService();
        return response()->json($progressService->getUserStats($user));
    });
});