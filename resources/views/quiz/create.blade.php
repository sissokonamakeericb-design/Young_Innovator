@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Créer un Quiz (QCM)</h2>

<form action="{{ route('quiz.store') }}" method="POST" class="space-y-4">
    @csrf

    {{-- Titre du Quiz --}}
    <div>
        <label class="block font-medium">Titre du Quiz</label>
        <input type="text" name="titre" class="w-full border rounded p-2" required>
    </div>

    {{-- Sélection du Cours --}}
    <div>
        <label class="block font-medium">Cours</label>
        <select name="cours_id" class="w-full border rounded p-2" required>
            @foreach($cours as $c)
                <option value="{{ $c->id }}">{{ $c->titre }}</option>
            @endforeach
        </select>
    </div>

    <h3 class="text-lg font-semibold mt-4">Questions (QCM)</h3>
    <div id="questionsContainer" class="space-y-4"></div>

    <button type="button" id="addQuestionBtn"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        + Ajouter une question
    </button>

    <div class="mt-4">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
            Créer le Quiz
        </button>
    </div>
</form>

{{-- Script QCM --}}
<script>
let questionIndex = 0;

document.getElementById('addQuestionBtn').addEventListener('click', () => {
    const container = document.getElementById('questionsContainer');

    const qcm = `
    <div class="border p-4 rounded bg-gray-50 shadow-sm">
        <label class="block font-semibold">Question</label>
        <input type="text" name="questions[${questionIndex}][texte]" class="w-full border rounded p-2" required>

        <div class="mt-3">
            <label class="font-medium">Options (QCM)</label>

            <div class="flex items-center mt-2">
                <input type="radio" name="questions[${questionIndex}][correct]" value="0" class="mr-2" checked>
                <input type="text" name="questions[${questionIndex}][options][]" placeholder="Option 1"
                    class="w-full border rounded p-2" required>
            </div>

            <div class="flex items-center mt-2">
                <input type="radio" name="questions[${questionIndex}][correct]" value="1" class="mr-2">
                <input type="text" name="questions[${questionIndex}][options][]" placeholder="Option 2"
                    class="w-full border rounded p-2" required>
            </div>

            <div class="flex items-center mt-2">
                <input type="radio" name="questions[${questionIndex}][correct]" value="2" class="mr-2">
                <input type="text" name="questions[${questionIndex}][options][]" placeholder="Option 3 (optionnel)"
                    class="w-full border rounded p-2">
            </div>

            <div class="flex items-center mt-2">
                <input type="radio" name="questions[${questionIndex}][correct]" value="3" class="mr-2">
                <input type="text" name="questions[${questionIndex}][options][]" placeholder="Option 4 (optionnel)"
                    class="w-full border rounded p-2">
            </div>
        </div>
    </div>
    `;

    container.insertAdjacentHTML('beforeend', qcm);
    questionIndex++;
});
</script>
@endsection
