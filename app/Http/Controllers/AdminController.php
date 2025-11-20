<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;
use App\Models\Quiz;
use App\Models\EnseignantRequest;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Vérifier que l'utilisateur est connecté et admin
        if (!$user || $user->role !== 'admin') {
            return redirect('/login')->with('error', 'Accès réservé aux administrateurs.');
        }

        // Statistiques
        $etudiantsCount = User::where('role', 'etudiant')->count();
        $enseignantsCount = User::where('role', 'enseignant')->count();
        $coursCount = Cours::count();
        $quizCount = Quiz::count();

        // Récupérer les demandes enseignants
        $enseignantRequests = EnseignantRequest::with('user')->latest()->get();

        // Récupérer les messages support depuis la table "support" (pas besoin de modèle si tu n’en as pas)
        $supportMessages = DB::table('supports')->latest()->get();

        // Passer toutes les variables à la vue
        return view('admin.dashboard', compact(
            'etudiantsCount',
            'enseignantsCount',
            'coursCount',
            'quizCount',
            'enseignantRequests',
            'supportMessages'
        ));
    }

    // Approuver une demande
    public function approveRequest($id)
    {
        $request = EnseignantRequest::findOrFail($id);

        $request->update(['status' => 'accepte']);

        $user = $request->user;
        $user->role = 'enseignant';
        $user->save();

        return back()->with('success', 'Demande approuvée ! L’utilisateur est maintenant enseignant.');
    }

    // Refuser une demande
    public function rejectRequest($id)
    {
        $request = EnseignantRequest::findOrFail($id);

        $request->update(['status' => 'refuse']);

        return back()->with('success', 'Demande refusée !');
    }


    public function editUser($id)
{
    $user = User::findOrFail($id);

    // Vérifier que l'utilisateur est admin
    $authUser = auth()->user();
    if (!$authUser || $authUser->role !== 'admin') {
        return redirect('/login')->with('error', 'Accès réservé aux administrateurs.');
    }

    return view('admin.edit-user', compact('user'));
}

public function suspendUser($id)
{
    $user = User::findOrFail($id);

    // Ici, tu peux soit changer un champ "statut" ou "suspendu" dans la table users
    // Assurons-nous d'avoir un champ `is_suspended` dans la table `users` (boolean)
    $user->is_suspended = !$user->is_suspended; // toggle suspension
    $user->save();

    $status = $user->is_suspended ? 'suspendu' : 'réactivé';

    return back()->with('success', "L'utilisateur a été $status avec succès !");
}

public function toggleSuspension($id)
{
    $user = User::findOrFail($id);

    // Inverser le statut de suspension
    $user->is_suspended = !$user->is_suspended;
    $user->save();

    $status = $user->is_suspended ? 'suspendu' : 'réactivé';

    return back()->with('success', "L'utilisateur a été $status avec succès !");
}

public function destroyUser($id)
{
    $user = \App\Models\User::findOrFail($id);

    // Empêcher la suppression d'un admin par erreur
    if ($user->role === 'admin') {
        return back()->with('error', 'Vous ne pouvez pas supprimer un administrateur.');
    }

    $user->delete();

    return back()->with('success', 'Utilisateur supprimé avec succès.');
}
// Dans AdminController.php


// Afficher tous les cours (admin)
public function showAllCours()
{
    $this->authorizeAdmin();

    $cours = Cours::with('enseignant')->get();
    return view('admin.cours.index', compact('cours'));
}

// Supprimer un cours
public function destroyCours($id)
{
    $this->authorizeAdmin();

    $cours = Cours::findOrFail($id);
    $cours->delete();

    return back()->with('success', 'Cours supprimé avec succès !');
}

// Afficher tous les quiz (admin)
public function showAllQuiz()
{
    $this->authorizeAdmin();

    $quiz = Quiz::with('cours', 'enseignant')->get();
    return view('admin.quiz.index', compact('quiz'));
}

// Supprimer un quiz
public function destroyQuiz($id)
{
    $this->authorizeAdmin();

    $quiz = Quiz::findOrFail($id);
    $quiz->delete();

    return back()->with('success', 'Quiz supprimé avec succès !');
}

// Méthode pour vérifier si l'utilisateur est admin
private function authorizeAdmin()
{
    $user = auth()->user();
    if (!$user || $user->role !== 'admin') {
        abort(403, 'Accès réservé aux administrateurs.');
    }
}


}
