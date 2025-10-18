<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Liste de toutes les questions
    public function index()
    {
        return response()->json(Question::with('quiz')->get(), 200);
    }

    // Afficher une question spécifique
    public function show($id)
    {
        $question = Question::with('quiz')->findOrFail($id);
        return response()->json($question, 200);
    }

    // Créer une question
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'reponse_correcte' => 'required|string',
            'quiz_id' => 'required|exists:quizzes,id'
        ]);

        $question = Question::create($request->all());

        return response()->json($question, 201);
    }

    // Mettre à jour une question
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return response()->json($question, 200);
    }

    // Supprimer une question
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(null, 204);
    }
}
