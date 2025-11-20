<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Cours;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Progression;
use App\Models\Badge;


use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CoursEtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SupportController;



Route::get('/', function () {
    return view('home');
});

// ================= Users =================
Route::prefix('users')->group(function () {
    Route::get('list', [UserController::class, 'indexView']);
    Route::get('create', [UserController::class, 'createView']);
    Route::get('edit/{id}', [UserController::class, 'editView']);
    Route::get('show/{id}', [UserController::class, 'showView']);
});

// ================= Cours =================
Route::prefix('cours')->group(function () {
    Route::get('list', [CoursController::class, 'indexView']);
    Route::get('create', [CoursController::class, 'createView']);
    Route::get('edit/{id}', [CoursController::class, 'editView']);
    Route::get('show/{id}', [CoursController::class, 'showView']);
});

// ================= Quiz =================
Route::prefix('quiz')->group(function () {
    Route::get('list', [QuizController::class, 'indexView']);
    Route::get('create', [QuizController::class, 'createView']);
    Route::get('edit/{id}', [QuizController::class, 'editView']);
    Route::get('show/{id}', [QuizController::class, 'showView']);
});

// Route pour afficher tous les quiz de l'étudiant
Route::get('/mes-quizzes', [EtudiantController::class, 'mesQuizzes'])->name('etudiant.mesQuizzes');

Route::get('/enseignant/mes-quizzes', [EnseignantController::class, 'mesQuizzes'])->name('enseignant.mesQuizzes');

// ================= Questions =================
Route::prefix('questions')->group(function () {
    Route::get('list', [QuestionController::class, 'indexView']);
    Route::get('create', [QuestionController::class, 'createView']);
    Route::get('edit/{id}', [QuestionController::class, 'editView']);
});

// ================= Progressions =================
Route::prefix('progressions')->group(function () {
    Route::get('list', [ProgressionController::class, 'indexView']);
});

// ================= Badges =================
Route::prefix('badges')->group(function () {
    Route::get('list', [BadgeController::class, 'indexView']);
    Route::get('create', [BadgeController::class, 'createView']);
    Route::get('edit/{id}', [BadgeController::class, 'editView']);
});


// Page d'accueil
Route::get('/', function () {
    return view('home', [
        'title' => 'Bienvenue sur Kalan Yoro'
    ]);
})->name('home');

// Tableau de bord (statique pour l’instant)
Route::view('/dashboard', 'home')->name('dashboard');

// 🔹 Utilisateurs
Route::get('/users', function () {
    $users = User::all();
    return view('users.index', compact('users'));
});

// 🔹 Cours
Route::get('/cours', function () {
    $cours = Cours::all();
    return view('cours.index', compact('cours'));
});

Route::get('/quiz', function () {
    $quizzes = Quiz::all(); // utilise le même nom que dans ta vue
    return view('quiz.index', compact('quizzes'));
});
// 🔹 Questions
Route::get('/questions', function () {
    $questions = Question::all();
    return view('questions.index', compact('questions'));
});

// 🔹 Progressions
Route::get('/progression', function () {
    $progressions = Progression::all();
    return view('progressions.index', compact('progressions'));
});

Route::get('/profil', function () {
    $user = auth()->user(); // récupère l'utilisateur connecté
    return view('profil', compact('user'));
})->middleware('auth')->name('profil');





Route::get('/support', [SupportController::class, 'index'])->name('support.index');
Route::post('/support', [SupportController::class, 'store'])->name('support.store');



// Afficher le profil
Route::get('/profil', function () {
    $user = auth()->user();
    return view('profil', compact('user'));
})->middleware('auth')->name('profil');

// Afficher le formulaire de modification
// Profil
Route::middleware('auth')->group(function() {
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
  Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/profil/password', [ProfilController::class, 'passwordForm'])->name('profil.password');
Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');

});


Route::get('/progression', [EtudiantController::class, 'progression'])
     ->name('etudiant.progression')
     ->middleware('auth');


// 🔹 Badges
Route::middleware('auth')->get('/badges', [BadgeController::class, 'index']);



Route::prefix('enseignant')->group(function () {
    Route::get('/dashboard', [EnseignantController::class, 'dashboard'])->name('enseignant.dashboard');
    Route::post('/cours/create', [EnseignantController::class, 'createCours'])->name('enseignant.createCours');
    Route::post('/quiz/create', [EnseignantController::class, 'createQuiz'])->name('enseignant.createQuiz');
    Route::post('/question/add', [EnseignantController::class, 'addQuestion'])->name('enseignant.addQuestion');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-quizzes', [EtudiantController::class, 'mesQuizzes'])->name('etudiant.mesQuizzes');
    Route::get('/quiz/{id}', [EtudiantController::class, 'showQuiz'])->name('etudiant.showQuiz');
});

Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');




Route::get('/quiz/{id}', [QuizController::class, 'showQuiz'])->name('etudiant.showQuiz');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submitQuiz'])->name('etudiant.submitQuiz');



Route::get('/devenir-enseignant', [EnseignantRequestController::class, 'create'])->name('enseignant.create');
Route::post('/devenir-enseignant', [EnseignantRequestController::class, 'store'])->name('enseignant.request');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');



Route::post('/admin/users/{id}/toggle-suspension', [AdminController::class, 'toggleSuspension'])->name('admin.users.toggleSuspension');

Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');



Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Demandes enseignants
    Route::post('/requests/{request}/approve', [AdminController::class, 'approveRequest'])->name('requests.approve');
    Route::post('/requests/{request}/reject', [AdminController::class, 'rejectRequest'])->name('requests.reject');

    // Gestion des utilisateurs
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('users.suspend');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});


Route::get('/etudiant/dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard');
Route::get('/etudiant/cours/{cours_id}/inscrire', [EtudiantController::class, 'inscrire']);
Route::get('/etudiant/cours/{cours_id}/retirer', [EtudiantController::class, 'retirer']);
Route::get('/etudiant/cours/{cours_id}/quizzes', [EtudiantController::class, 'quizzes']);
Route::get('/etudiant/quiz/{quiz_id}', [EtudiantController::class, 'showQuiz']);



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/cours', [CoursEtudiantController::class, 'index'])->name('cours.index');
    Route::get('/mes-cours', [CoursEtudiantController::class, 'mesCours'])->name('cours.mes');

    // POST pour s'inscrire / se désinscrire
    Route::post('/cours/{id}/suivre', [CoursEtudiantController::class, 'suivre'])->name('cours.suivre');
    Route::post('/cours/{id}/retirer', [CoursEtudiantController::class, 'retirer'])->name('cours.retirer');
});

// Gestion cours par admin
Route::get('/admin/cours', [AdminController::class, 'showAllCours'])->name('admin.cours.index');
Route::delete('/admin/cours/{id}', [AdminController::class, 'destroyCours'])->name('admin.cours.destroy');

// Gestion quiz par admin
Route::get('/admin/quiz', [AdminController::class, 'showAllQuiz'])->name('admin.quiz.index');
Route::delete('/admin/quiz/{id}', [AdminController::class, 'destroyQuiz'])->name('admin.quiz.destroy');


