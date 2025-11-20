@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Créer un cours</h2>

<form action="/cours" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium">Titre</label>
        <input name="titre" class="mt-1 w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" class="mt-1 w-full border rounded p-2" rows="4"></textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Catégorie</label>
            <input name="categorie" class="mt-1 w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Enseignant (ID)</label>
            <input name="enseignant_id" type="number" class="mt-1 w-full border rounded p-2" required>
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium">Image de couverture</label>
        <input name="image" type="file" class="mt-1 w-full">
    </div>
    <div>
        <label class="block text-sm font-medium">Vidéo (URL ou laisser vide)</label>
        <input name="video" class="mt-1 w-full border rounded p-2">
    </div>

    <div class="pt-4">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Créer</button>
        <a href="/cours" class="ml-3 text-sm text-gray-500">Annuler</a>
    </div>
</form>
@endsection