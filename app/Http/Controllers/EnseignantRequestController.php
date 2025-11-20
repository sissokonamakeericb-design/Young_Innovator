<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnseignantRequest;
use Illuminate\Support\Facades\Auth;

class EnseignantRequestController extends Controller
{
    /**
     * Affiche le formulaire de demande pour devenir enseignant
     */
    public function create()
    {
        return view('enseignant_request.create'); // Assurez-vous que ce fichier existe
    }

    /**
     * Enregistre la demande dans la base
     */
    public function store(Request $request)
    {
        $request->validate([
            'specialite' => 'required|string|max:255',
            'niveau_etude' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        EnseignantRequest::create([
            'user_id' => Auth::id(), // Assurez-vous que l'utilisateur est connecté
            'specialite' => $request->specialite,
            'niveau_etude' => $request->niveau_etude,
            'description' => $request->description,
            'cv' => $cvPath,
            'status' => 'en_attente', // ou 'pending'
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
