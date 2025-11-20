@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Ajouter un utilisateur</h2>

<form action="/users" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Prénom</label>
            <input name="prenom" class="mt-1 block w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Nom</label>
            <input name="nom" class="mt-1 block w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input name="email" type="email" class="mt-1 block w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Téléphone</label>
            <input name="telephone" class="mt-1 block w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Mot de passe</label>
            <input name="password" type="password" class="mt-1 block w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Rôle</label>
            <select name="role" class="mt-1 block w-full border rounded p-2">
                <option value="etudiant">Étudiant</option>
                <option value="enseignant">Enseignant</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium">Photo de profil</label>
            <input name="photo_profil" type="file" class="mt-1 block w-full">
        </div>
    </div>

    <div class="pt-4">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="/users" class="ml-3 text-sm text-gray-500">Annuler</a>
    </div>
</form>
@endsection