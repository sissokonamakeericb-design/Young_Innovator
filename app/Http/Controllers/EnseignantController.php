<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class EnseignantController extends Controller
{
    // Tableau de bord de l'enseignant connecté
    public function dashboard()
    {
        $enseignant = auth()->user();

        if (!$enseignant || $enseignant->role !== 'enseignant') {
            abort(403, 'Accès interdit');
        }

        $cours = Cours::where('enseignant_id', $enseignant->id)->get();
        $quiz = Quiz::where('enseignant_id', $enseignant->id)->get();

        return view('enseignant.dashboard', compact('enseignant', 'cours', 'quiz'));
    }

    // Créer un nouveau cours
    public function createCours(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $enseignant = auth()->user();

        if ($enseignant->role !== 'enseignant') {
            abort(403);
        }

        Cours::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? '',
            'enseignant_id' => $enseignant->id,
        ]);

        return redirect()->route('enseignant.dashboard')->with('success', 'Cours créé avec succès !');
    }

    // Créer un quiz
    public function createQuiz(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'cours_id' => 'required|exists:cours,id',
        ]);

        $enseignant = auth()->user();

        // Sécurité : vérifier que le cours appartient à l'enseignant
        $cours = Cours::where('id', $validated['cours_id'])
            ->where('enseignant_id', $enseignant->id)
            ->firstOrFail();

        Quiz::create([
            'titre' => $validated['titre'],
            'cours_id' => $cours->id,
            'enseignant_id' => $enseignant->id,
        ]);

        return redirect()->route('enseignant.dashboard')->with('success', 'Quiz créé avec succès !');
    }

    // Ajouter une question à un quiz
    public function addQuestion(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'reponse_correcte' => 'required|string',
            'options' => 'required|array|min:2',
        ]);

        $enseignant = auth()->user();

        // Vérifier que le quiz appartient à l'enseignant connecté
        $quiz = Quiz::where('id', $validated['quiz_id'])
            ->where('enseignant_id', $enseignant->id)
            ->firstOrFail();

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => $validated['question'],
            'options' => json_encode($validated['options']),
            'reponse_correcte' => $validated['reponse_correcte'],
        ]);

        return redirect()->route('enseignant.dashboard')->with('success', 'Question ajoutée avec succès !');
    }


    public function mesQuizzes()
{
    $enseignant = auth()->user();

    if (!$enseignant || $enseignant->role !== 'enseignant') {
        return redirect('/login')->with('error', 'Veuillez vous connecter en tant qu’enseignant.');
    }

    // Récupérer les quiz des cours que cet enseignant suit/crée
    $quizzes = \App\Models\Quiz::where('enseignant_id', $enseignant->id)
                ->with('cours', 'questions')
                ->get();

    return view('enseignant.mes-quizzes', compact('quizzes'));
}

}
