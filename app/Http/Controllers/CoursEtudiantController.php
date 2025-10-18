<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;

class CoursEtudiantController extends Controller
{
    // Inscrire un étudiant à un cours
    public function inscrire(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $cours = Cours::findOrFail($request->cours_id);

        $user->coursInscrits()->syncWithoutDetaching([$cours->id]);

        return response()->json([
            'message' => "Étudiant inscrit au cours avec succès."
        ]);
    }

    // Retirer un étudiant d'un cours
    public function retirer(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $cours = Cours::findOrFail($request->cours_id);

        $user->coursInscrits()->detach($cours->id);

        return response()->json([
            'message' => "Étudiant retiré du cours."
        ]);
    }

    // Lister tous les étudiants d'un cours
    public function etudiantsDuCours($cours_id)
    {
        $cours = Cours::findOrFail($cours_id);
        return response()->json($cours->etudiants);
    }

    // Lister tous les cours d’un étudiant
    public function coursDeEtudiant($user_id)
    {
        $user = User::findOrFail($user_id);
        return response()->json($user->coursInscrits);
    }
}
