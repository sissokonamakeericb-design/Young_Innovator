@extends('layouts.dashboard')
@section('content')
<h2 class="text-2xl font-bold mb-4">Modifier la question</h2>

<form action="/questions/{{ $question->id }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
  @csrf @method('PUT')

  <div>
    <label class="block text-sm font-medium">Quiz (ID)</label>
    <input name="quiz_id" value="{{ old('quiz_id', $question->quiz_id) }}" class="mt-1 w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block text-sm font-medium">Texte de la question</label>
    <textarea name="question" class="mt-1 w-full border rounded p-2" rows="3" required>{{ old('question', $question->question ?? $question->intitule) }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium">Options (séparés par des virgules)</label>
    <input name="options_raw" value="{{ old('options_raw', is_array($question->options) ? implode(',', $question->options) : '') }}" class="mt-1 w-full border rounded p-2">
  </div>

  <div>
    <label class="block text-sm font-medium">Réponse correcte</label>
    <input name="reponse_correcte" value="{{ old('reponse_correcte', $question->reponse_correcte) }}" class="mt-1 w-full border rounded p-2">
  </div>

  <div class="pt-4">
    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    <a href="/questions" class="ml-3 text-sm text-gray-500">Annuler</a>
  </div>
</form>
@endsection
