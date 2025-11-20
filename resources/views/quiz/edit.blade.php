@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Modifier le quiz</h2>

<form action="/quiz/{{ $quiz->id }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
    @csrf @method('PUT')
    <div>
        <label class="block text-sm font-medium">Titre</label>
        <input name="titre" value="{{ old('titre', $quiz->titre) }}" class="mt-1 w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" class="mt-1 w-full border rounded p-2">{{ old('description', $quiz->description) }}</textarea>
    </div>

    <div class="pt-4">
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="/quiz" class="ml-3 text-sm text-gray-500">Annuler</a>
    </div>
</form>
@endsection