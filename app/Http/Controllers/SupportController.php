<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function store(Request $request)
    {
        // Validation simple
        $request->validate([
            'message' => 'required|min:5',
        ]);

        // Ici, tu peux enregistrer dans la BD si tu veux

        return redirect()
            ->route('support.index')
            ->with('success', 'Votre message a été envoyé avec succès !');
    }
}
