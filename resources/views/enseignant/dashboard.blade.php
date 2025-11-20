@extends('layouts.dashboard')

@section('content')

<div class="mb-10">
    <h2 class="text-4xl font-extrabold text-indigo-700 tracking-tight">🎓 Dashboard Enseignant</h2>
    <p class="text-gray-600 mt-2">Gérez vos cours et vos quiz facilement.</p>
</div>

{{-- HEADER ACTIONS --}}
<div class="flex flex-wrap gap-3 mb-10">
    <button onclick="document.getElementById('coursForm').classList.toggle('hidden')" 
        class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition font-semibold">
        ➕ Nouveau cours
    </button>

    <button onclick="document.getElementById('quizForm').classList.toggle('hidden')" 
        class="bg-green-600 text-white px-6 py-2 rounded-xl shadow hover:bg-green-700 transition font-semibold">
        📝 Nouveau quiz
    </button>
</div>

{{-- PROFIL --}}
<div class="bg-white p-6 rounded-2xl shadow-lg mb-10 flex items-center gap-6">
    <img src="{{ $enseignant->photo_profil ?? 'https://ui-avatars.com/api/?name='.$enseignant->prenom }}" 
         class="w-20 h-20 rounded-full object-cover border-4 border-indigo-500 shadow">

    <div>
        <h3 class="text-2xl font-bold text-gray-800">
            {{ $enseignant->prenom }} {{ $enseignant->nom }}
        </h3>
        <p class="text-gray-500 text-sm">Enseignant</p>
    </div>
</div>

{{-- FORMULAIRE COURS --}}
<div id="coursForm" class="bg-blue-50 p-6 rounded-2xl shadow-lg mb-10 hidden border border-blue-100">
    <h3 class="text-xl font-bold text-blue-700 mb-4">Créer un nouveau cours</h3>

    <form action="{{ route('enseignant.createCours') }}" method="POST">
        @csrf

        <input type="text" name="titre" placeholder="Titre du cours" 
               class="border p-3 rounded-lg w-full mb-4 focus:ring-2 focus:ring-blue-400" required>

        <textarea name="description" placeholder="Description du cours" 
                  class="border p-3 rounded-lg w-full mb-4 focus:ring-2 focus:ring-blue-400"></textarea>

        <button type="submit" 
                class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition font-semibold shadow">
            ✔️ Créer le cours
        </button>
    </form>
</div>

{{-- FORMULAIRE QUIZ --}}
<div id="quizForm" class="bg-green-50 p-6 rounded-2xl shadow-lg mb-10 hidden border border-green-100">
    <h3 class="text-xl font-bold text-green-700 mb-4">Créer un nouveau quiz (QCM)</h3>

    <form action="{{ route('quiz.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Titre --}}
        <input type="text" name="titre" placeholder="Titre du quiz"
               class="border p-3 rounded-lg w-full mb-4 focus:ring-2 focus:ring-green-400" required>

        {{-- Sélection cours --}}
        <select name="cours_id" 
                class="border p-3 rounded-lg w-full mb-4 focus:ring-2 focus:ring-green-400" required>
            <option value="">Associer à un cours…</option>
            @foreach($cours as $c)
                <option value="{{ $c->id }}">{{ $c->titre }}</option>
            @endforeach
        </select>

        {{-- Questions dynamiques --}}
        <h4 class="text-lg font-semibold text-gray-700">Questions du QCM</h4>
        <div id="questionsContainer" class="space-y-4"></div>

        <button type="button" id="addQuestionBtn"
                class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition font-semibold shadow">
            ➕ Ajouter une question
        </button>

        <div>
            <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition font-semibold shadow">
                ✔️ Créer le Quiz
            </button>
        </div>
    </form>
</div>

{{-- SCRIPT QUESTIONS DYNAMIQUES --}}
<script>
let questionIndex = 0;

document.getElementById('addQuestionBtn').addEventListener('click', function () {

    const container = document.getElementById('questionsContainer');

    const q = `
    <div class="border p-4 rounded-xl bg-white shadow-md">
        <label class="font-semibold">Question</label>
        <input type="text" name="questions[${questionIndex}][texte]"
               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-300 mt-1" required>

        <div class="mt-3">
            <label class="font-semibold">Options</label>

            ${[1,2,3,4].map((i) => `
                <div class="flex items-center gap-3 mt-2">
                    <input type="radio" name="questions[${questionIndex}][correct]" value="${i-1}" class="h-4 w-4">
                    <input type="text" name="questions[${questionIndex}][options][]" 
                           placeholder="Option ${i}"
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-300">
                </div>
            `).join('')}
        </div>

        <button type="button"
                onclick="this.parentElement.remove()"
                class="mt-4 bg-red-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-700 shadow">
            🗑️ Supprimer cette question
        </button>
    </div>`;

    container.insertAdjacentHTML('beforeend', q);
    questionIndex++;
});
</script>

{{-- LISTE DES COURS --}}
<div class="bg-white rounded-2xl shadow-lg mb-10 overflow-hidden">
    <h3 class="text-2xl font-bold p-6 border-b text-gray-700">📚 Vos Cours</h3>

    <table class="min-w-full">
        <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
            <tr>
                <th class="p-4">Titre</th>
                <th class="p-4">Description</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cours as $c)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-4 font-medium">{{ $c->titre }}</td>
                <td class="p-4 text-gray-600">{{ $c->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- LISTE DES QUIZ --}}
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <h3 class="text-2xl font-bold p-6 border-b text-gray-700">📝 Vos Quiz</h3>

    <table class="min-w-full">
        <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
            <tr>
                <th class="p-4">Titre</th>
                <th class="p-4">Cours</th>
            </tr>
        </thead>

        <tbody>
            @foreach($quiz as $q)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-4 font-medium">{{ $q->titre }}</td>
                <td class="p-4 text-gray-600">{{ $q->cours->titre ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection
