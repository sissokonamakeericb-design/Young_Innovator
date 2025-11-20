<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;

class CoursEtudiantController extends Controller
{
    // Afficher tous les cours
   public function index()
{
    $etudiant = Auth::user();
    $cours = Cours::all();

    // Préciser la table pour éviter l'ambiguïté
    $coursSuivis = $etudiant->coursSuivis()->pluck('cours.id')->toArray();

    return view('etudiant.cours.index', compact('cours', 'coursSuivis'));
}


    // Afficher les cours suivis par l’étudiant
    public function mesCours()
    {
        $etudiant = Auth::user();
        $cours = $etudiant->coursSuivis()->get();

        return view('etudiant.cours.mes-cours', compact('cours'));
    }

    // S'inscrire à un cours
    public function suivre($id)
    {
        $etudiant = Auth::user();
        $cours = Cours::findOrFail($id);

        $etudiant->coursSuivis()->syncWithoutDetaching([$cours->id]);

        return redirect()->back()->with('success', "Inscription au cours '{$cours->titre}' réussie !");
    }

    // Se désinscrire d’un cours
    public function retirer($id)
    {
        $etudiant = Auth::user();
        $cours = Cours::findOrFail($id);

        $etudiant->coursSuivis()->detach($cours->id);

        return redirect()->back()->with('success', "Vous avez quitté le cours '{$cours->titre}'.");
    }
}
