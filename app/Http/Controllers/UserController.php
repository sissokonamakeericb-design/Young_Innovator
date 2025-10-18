<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Liste de tous les utilisateurs
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Afficher un utilisateur
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    // Créer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'telephone' => 'nullable|string|max:20',
            'role' => 'nullable|in:etudiant,enseignant,admin',
            'photo_profil' => 'nullable|image|max:2048'
        ]);

        $user = new User();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->role = $request->role ?? 'etudiant';
        $user->password = Hash::make($request->password);

        // Gestion de la photo de profil
        if ($request->hasFile('photo_profil')) {
            $path = $request->file('photo_profil')->store('public/profils');
            $user->photo_profil = Storage::url($path);
        }

        $user->save();

        return response()->json($user, 201);
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'prenom' => 'nullable|string|max:50',
            'nom' => 'nullable|string|max:50',
            'email' => 'nullable|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'telephone' => 'nullable|string|max:20',
            'role' => 'nullable|in:etudiant,enseignant,admin',
            'photo_profil' => 'nullable|image|max:2048'
        ]);

        $user->prenom = $request->prenom ?? $user->prenom;
        $user->nom = $request->nom ?? $user->nom;
        $user->email = $request->email ?? $user->email;
        $user->telephone = $request->telephone ?? $user->telephone;
        $user->role = $request->role ?? $user->role;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Gestion de la photo de profil
        if ($request->hasFile('photo_profil')) {
            // Supprime l’ancienne photo si elle existe
            if ($user->photo_profil) {
                $oldPath = str_replace('/storage/', 'public/', $user->photo_profil);
                Storage::delete($oldPath);
            }
            $path = $request->file('photo_profil')->store('public/profils');
            $user->photo_profil = Storage::url($path);
        }

        $user->save();

        return response()->json($user, 200);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Supprime la photo si elle existe
        if ($user->photo_profil) {
            $oldPath = str_replace('/storage/', 'public/', $user->photo_profil);
            Storage::delete($oldPath);
        }

        $user->delete();

        return response()->json(null, 204);
    }
}
