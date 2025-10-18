<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Liste de tous les quiz
    public function index()
    {
        return response()->json(Quiz::with('cours', 'enseignant', 'questions')->get(), 200);
    }

    // Afficher un quiz spécifique
    public function show($id)
    {
        $quiz = Quiz::with('cours', 'enseignant', 'questions')->findOrFail($id);
        return response()->json($quiz, 200);
    }

    // Créer un quiz
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cours_id' => 'required|exists:cours,id',
            'enseignant_id' => 'required|exists:users,id'
        ]);

        $quiz = Quiz::create($request->all());

        return response()->json($quiz, 201);
    }

    // Mettre à jour un quiz
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->update($request->all());

        return response()->json($quiz, 200);
    }

    // Supprimer un quiz
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return response()->json(null, 204);
    }
}
