<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    // Liste de tous les cours
    public function index()
    {
        return response()->json(Cours::with('enseignant')->get(), 200);
    }

    // Afficher un cours spécifique
    public function show($id)
    {
        $cours = Cours::with('enseignant', 'etudiants', 'quizzes')->findOrFail($id);
        return response()->json($cours, 200);
    }

    // Créer un nouveau cours
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'enseignant_id' => 'required|exists:users,id'
        ]);

        $cours = new Cours();
        $cours->titre = $request->titre;
        $cours->description = $request->description;
        $cours->categorie = $request->categorie;
        $cours->enseignant_id = $request->enseignant_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/cours');
            $cours->image = Storage::url($path);
        }

        if ($request->hasFile('video')) {
    $path = $request->file('video')->store('public/cours_videos');
    $cours->video = Storage::url($path);
}


        $cours->save();

        return response()->json($cours, 201);
    }

    // Mettre à jour un cours
    public function update(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);

        $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048'
        ]);

        $cours->titre = $request->titre ?? $cours->titre;
        $cours->description = $request->description ?? $cours->description;
        $cours->categorie = $request->categorie ?? $cours->categorie;

        if ($request->hasFile('image')) {
            if ($cours->image) {
                $oldPath = str_replace('/storage/', 'public/', $cours->image);
                Storage::delete($oldPath);
            }
            $path = $request->file('image')->store('public/cours');
            $cours->image = Storage::url($path);
        }

        if ($request->hasFile('video')) {
    $path = $request->file('video')->store('public/cours_videos');
    $cours->video = Storage::url($path);
}


        $cours->save();

        

        return response()->json($cours, 200);
    }

    // Supprimer un cours
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);

        if ($cours->image) {
            $oldPath = str_replace('/storage/', 'public/', $cours->image);
            Storage::delete($oldPath);
        }

        $cours->delete();

        return response()->json(null, 204);
    }
}
