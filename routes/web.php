<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\CoursEtudiantController;






Route::get('/', function () {
    return view('welcome');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);        // liste
    Route::get('{id}', [UserController::class, 'show']);     // un utilisateur
    Route::post('/', [UserController::class, 'store']);      // créer
    Route::put('{id}', [UserController::class, 'update']);   // mettre à jour
    Route::delete('{id}', [UserController::class, 'destroy']); // supprimer
});



Route::prefix('cours')->group(function () {
    Route::get('/', [CoursController::class, 'index']);
    Route::get('{id}', [CoursController::class, 'show']);
    Route::post('/', [CoursController::class, 'store']);
    Route::put('{id}', [CoursController::class, 'update']);
    Route::delete('{id}', [CoursController::class, 'destroy']);
});



Route::prefix('quiz')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::get('{id}', [QuizController::class, 'show']);
    Route::post('/', [QuizController::class, 'store']);
    Route::put('{id}', [QuizController::class, 'update']);
    Route::delete('{id}', [QuizController::class, 'destroy']);
});



Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index']);
    Route::get('{id}', [QuestionController::class, 'show']);
    Route::post('/', [QuestionController::class, 'store']);
    Route::put('{id}', [QuestionController::class, 'update']);
    Route::delete('{id}', [QuestionController::class, 'destroy']);
});



Route::prefix('progressions')->group(function () {
    Route::get('/', [ProgressionController::class, 'index']);
    Route::post('/', [ProgressionController::class, 'store']);
    Route::put('{id}', [ProgressionController::class, 'update']);
    Route::delete('{id}', [ProgressionController::class, 'destroy']);
});


use App\Http\Controllers\BadgeController;

Route::get('/badges', [BadgeController::class, 'index']);
Route::post('/badges', [BadgeController::class, 'store']);
Route::post('/badges/assign/{user_id}', [BadgeController::class, 'assignBadge']);
Route::post('/badges/remove/{user_id}', [BadgeController::class, 'removeBadge']);
Route::get('/badges/user/{user_id}', [BadgeController::class, 'userBadges']);



Route::post('/cours/inscrire/{user_id}', [CoursEtudiantController::class, 'inscrire']);
Route::post('/cours/retirer/{user_id}', [CoursEtudiantController::class, 'retirer']);
Route::get('/cours/etudiants/{cours_id}', [CoursEtudiantController::class, 'etudiantsDuCours']);
Route::get('/cours/etudiant/{user_id}', [CoursEtudiantController::class, 'coursDeEtudiant']);
