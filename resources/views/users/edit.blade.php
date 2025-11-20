@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Modifier l'utilisateur</h2>

<form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow">
  @csrf @method('PUT')

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium">Prénom</label>
      <input name="prenom" value="{{ old('prenom', $user->prenom) }}" class="mt-1 block w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">Nom</label>
      <input name="nom" value="{{ old('nom', $user->nom) }}" class="mt-1 block w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">Téléphone</label>
      <input name="telephone" value="{{ old('telephone', $user->telephone) }}" class="mt-1 block w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">Nouveau mot de passe (laisser vide pour conserver)</label>
      <input name="password" type="password" class="mt-1 block w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">Rôle</label>
      <select name="role" class="mt-1 block w-full border rounded p-2">
        <option value="etudiant" @if($user->role=='etudiant') selected @endif>Étudiant</option>
        <option value="enseignant" @if($user->role=='enseignant') selected @endif>Enseignant</option>
        <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
      </select>
    </div>
    <div class="md:col-span-2">
      <label class="block text-sm font-medium">Photo de profil</label>
      <input name="photo_profil" type="file" class="mt-1 block w-full">
    </div>
  </div>

  <div class="pt-4">
    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    <a href="/users" class="ml-3 text-sm text-gray-500">Annuler</a>
  </div>
</form>
@endsection
