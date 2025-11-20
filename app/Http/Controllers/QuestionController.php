<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Afficher le quiz pour l'étudiant
    public function showQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('etudiant.quiz', compact('quiz'));
    }

    // Soumettre le quiz
    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $score = 0;

        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input('question_'.$question->id);

            // Vérifie la réponse (l'indice)
            if ($userAnswer !== null && intval($userAnswer) == $question->reponse_correcte) {
                $score++;
            }
        }

        return back()->with('success', "Vous avez obtenu $score / ".$quiz->questions->count());
    }
}
