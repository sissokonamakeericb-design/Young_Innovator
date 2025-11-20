@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Ajouter une question</h2>

<form action="/questions" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
  @csrf

  <div>
    <label class="block text-sm font-medium">Quiz (ID)</label>
    <input name="quiz_id" value="{{ request('quiz_id') }}" class="mt-1 w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block text-sm font-medium">Texte de la question</label>
    <textarea name="question" class="mt-1 w-full border rounded p-2" rows="3" required></textarea>
  </div>

  <div>
    <label class="block text-sm font-medium">Options (séparez par une virgule)</label>
    <input name="options_raw" placeholder="Option A,Option B,Option C" class="mt-1 w-full border rounded p-2">
    <p class="text-xs text-gray-400 mt-1">Le controller peut convertir en JSON en séparant par des virgules.</p>
  </div>

  <div>
    <label class="block text-sm font-medium">Réponse correcte (texte exact)</label>
    <input name="reponse_correcte" class="mt-1 w-full border rounded p-2" required>
  </div>

  <div class="pt-4">
    <button class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
    <a href="/questions" class="ml-3 text-sm text-gray-500">Annuler</a>
  </div>
</form>
@endsection
