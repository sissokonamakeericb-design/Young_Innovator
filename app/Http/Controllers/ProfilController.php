<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Afficher le profil
    public function show()
    {
        $user = Auth::user();
        return view('profil.show', compact('user'));
    }

    // Formulaire modification
    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    // Mettre à jour le profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'photo_profil' => 'nullable|image|max:2048'
        ]);

        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;

        if ($request->hasFile('photo_profil')) {
            $file = $request->file('photo_profil');
            $path = $file->store('uploads', 'public');
            $user->photo_profil = '/storage/'.$path;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil mis à jour avec succès !');
    }

    // Formulaire changement de mot de passe
    public function passwordForm()
    {
        return view('profil.password');
    }

    // Mettre à jour le mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profil')->with('success', 'Mot de passe mis à jour !');
    }
}
