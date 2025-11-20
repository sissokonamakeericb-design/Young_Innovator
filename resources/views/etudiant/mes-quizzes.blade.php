@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Mes Quizzes</h2>

@if($quizzes->isEmpty())
    <p>Aucun quiz disponible pour le moment.</p>
@else
    @foreach($quizzes as $quiz)
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">

            <h2 class="text-3xl font-bold text-indigo-700 mb-4 border-b pb-2">{{ $quiz->titre }}</h2>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 text-gray-700">
                <p><span class="font-semibold">Cours :</span> {{ $quiz->cours->titre }}</p>
                <p class="mt-2 md:mt-0"><span class="font-semibold">Enseignant :</span> {{ $quiz->enseignant->prenom }} {{ $quiz->enseignant->nom }}</p>
            </div>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Questions :</h3>
            <ul class="list-disc ml-6 mt-2">
                @foreach($quiz->questions as $question)
                    <li>{{ $question->texte }}</li>
                @endforeach
            </ul>

            <a href="{{ route('etudiant.showQuiz', $quiz->id) }}" class="text-blue-600 hover:underline mt-3 inline-block">
                Voir le quiz en détail
            </a>
        </div>
    @endforeach
@endif
@endsection
