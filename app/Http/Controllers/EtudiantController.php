<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;

class EtudiantController extends Controller
{
    // Dashboard étudiant
    public function dashboard()
    {
        $etudiant = auth()->user();

        if (!$etudiant || $etudiant->role !== 'etudiant') {
            return redirect('/login')->with('error', 'Veuillez vous connecter en tant qu’étudiant.');
        }

        $cours = Cours::all();
        $coursSuivis = $etudiant->coursSuivis()->get();
        $badges = $etudiant->badges()->get();
        $progressions = $etudiant->progressions()->get();

        return view('etudiant.dashboard', [
            'user' => $etudiant,
            'cours' => $cours,
            'coursSuivis' => $coursSuivis,
            'badges' => $badges,
            'progressions' => $progressions,
            'title' => 'Dashboard Étudiant',
        ]);
    }

    // S’inscrire à un cours
    public function inscrire($cours_id)
    {
        $etudiant = auth()->user();

        if (!$etudiant || $etudiant->role !== 'etudiant') {
            return back()->with('error', 'Action non autorisée.');
        }

        if (!$etudiant->coursSuivis()->where('cours_id', $cours_id)->exists()) {
            $etudiant->coursSuivis()->attach($cours_id);
        }

        return back()->with('success', 'Inscription réussie !');
    }

    // Se désinscrire d’un cours
    public function retirer($cours_id)
    {
        $etudiant = auth()->user();

        if (!$etudiant || $etudiant->role !== 'etudiant') {
            return back()->with('error', 'Action non autorisée.');
        }

        $etudiant->coursSuivis()->detach($cours_id);

        return back()->with('success', 'Vous avez été désinscrit du cours.');
    }

    // Afficher les quizzes d’un cours
    public function mesQuizzes()
{
    $etudiant = auth()->user();

    if (!$etudiant || $etudiant->role !== 'etudiant') {
        return redirect('/login')->with('error', 'Veuillez vous connecter en tant qu’étudiant.');
    }

    // Récupère les cours suivis par l'étudiant
    $coursIds = $etudiant->coursSuivis()->pluck('cours_id');

    // Récupère tous les quizzes de ces cours
    $quizzes = \App\Models\Quiz::whereIn('cours_id', $coursIds)
                ->with('cours', 'enseignant')
                ->get();

    return view('etudiant.mes-quizzes', compact('quizzes'));
}


    // Afficher un quiz spécifique
    public function showQuiz($quiz_id)
    {
        $etudiant = auth()->user();

        if (!$etudiant || $etudiant->role !== 'etudiant') {
            return redirect('/login')->with('error', 'Action non autorisée.');
        }

        $quiz = \App\Models\Quiz::with('questions')->findOrFail($quiz_id);

        return view('etudiant.quiz', compact('quiz'));
    }

    public function progression()
{
    $etudiant = auth()->user();

    // Vérifie que l'utilisateur est bien un étudiant
    if (!$etudiant || $etudiant->role !== 'etudiant') {
        return redirect('/login')->with('error', 'Veuillez vous connecter en tant qu’étudiant.');
    }

    // Récupère uniquement les progressions de l'étudiant connecté
    $progressions = $etudiant->progressions()->get();

    return view('etudiant.progression', [
        'progressions' => $progressions,
        'title' => 'Ma progression',
    ]);
}

}
