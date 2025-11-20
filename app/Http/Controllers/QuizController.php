<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // ------------------------------
    // Affichage des quizzes pour Blade
    // ------------------------------
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'enseignant') {
            // L'enseignant voit uniquement ses quiz
            $quizzes = Quiz::with('cours', 'questions')
                ->where('enseignant_id', $user->id)
                ->get();
        } elseif ($user->role === 'etudiant') {
            // L'étudiant voit tous les quiz
            $quizzes = Quiz::with('cours', 'enseignant', 'questions')->get();
        } else {
            abort(403, 'Accès interdit');
        }

        return view('quiz.index', compact('quizzes'));
    }

    // ------------------------------
    // Affichage d'un quiz spécifique (Blade)
    // ------------------------------
    public function show($id)
    {
        $quiz = Quiz::with('cours', 'enseignant', 'questions')->findOrFail($id);
        $user = Auth::user();

        // Vérification : un étudiant ou l'enseignant propriétaire peut voir
        if ($user->role === 'enseignant' && $quiz->enseignant_id !== $user->id) {
            abort(403, 'Accès interdit');
        }

        return view('quiz.show', compact('quiz'));
    }

    // ------------------------------
    // CRUD pour enseignants uniquement
    // ------------------------------
    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'enseignant') abort(403, 'Accès interdit');
        return view('quiz.create');
    }

public function store(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'enseignant') abort(403);

    $request->validate([
        'titre' => 'required|string|max:255',
        'cours_id' => 'required|exists:cours,id',
        'questions' => 'required|array|min:1',

        // chaque question
        'questions.*.question' => 'required|string',
        'questions.*.options' => 'required|array|min:2',
        'questions.*.reponse_correcte' => 'required|string',
    ]);

    // Création du quiz
    $quiz = Quiz::create([
        'titre' => $request->titre,
        'cours_id' => $request->cours_id,
        'enseignant_id' => $user->id,
    ]);

    // Ajout des questions
    foreach ($request->questions as $q) {
        \App\Models\Question::create([
            'quiz_id' => $quiz->id,
            'question' => $q['question'],           // OK
            'options' => json_encode($q['options']), // OK
            'reponse_correcte' => $q['reponse_correcte'], // OK
        ]);
    }

    return redirect()->route('quiz.index')->with('success', 'Quiz QCM créé avec succès !');
}



    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'enseignant' || $quiz->enseignant_id !== $user->id) {
            abort(403, 'Accès interdit');
        }

        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'enseignant' || $quiz->enseignant_id !== $user->id) {
            abort(403, 'Accès interdit');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz->update([
            'titre' => $request->titre,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz mis à jour !');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'enseignant' || $quiz->enseignant_id !== $user->id) {
            abort(403, 'Accès interdit');
        }

        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz supprimé !');
    }

    // ------------------------------
    // API : Affichage JSON
    // ------------------------------
    public function indexApi()
    {
        $quizzes = Quiz::with('cours', 'enseignant', 'questions')->get();
        return response()->json($quizzes, 200);
    }

    public function showApi($id)
    {
        $quiz = Quiz::with('cours', 'enseignant', 'questions')->findOrFail($id);
        return response()->json($quiz, 200);
    }



    public function showQuiz($id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);

    return view('etudiant.quiz', compact('quiz'));
}



public function submitQuiz(Request $request, $id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);
    $score = 0;

    foreach ($quiz->questions as $question) {
        $userAnswer = $request->input('question_' . $question->id);

        if ($userAnswer !== null && $userAnswer == $question->reponse_correcte) {
            $score++;
        }
    }

    return back()->with('success', "Vous avez obtenu $score / " . $quiz->questions->count());
}


}
