@extends('layouts.dashboard')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8">

    <h2 class="text-3xl font-bold text-indigo-700 mb-4">{{ $quiz->titre }}</h2>

    <p class="text-gray-600"><strong>Cours :</strong> {{ $quiz->cours->titre }}</p>

    <hr class="my-4">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('etudiant.submitQuiz', $quiz->id) }}" method="POST">
        @csrf

        <h3 class="text-xl font-semibold mb-4">Répondez aux questions :</h3>

        <div class="space-y-6">

            @foreach($quiz->questions as $index => $q)
                <div class="border p-5 rounded-xl bg-gray-50 shadow-sm">
                    <h4 class="font-bold text-lg mb-2">
                        Question {{ $index + 1 }} :
                        <span class="text-gray-700">{{ $q->texte }}</span>
                    </h4>

                    @php
                        $options = json_decode($q->options, true);
                    @endphp

                    <div class="space-y-2">
                        @foreach($options as $i => $option)
                            <label class="flex items-center gap-2 bg-white p-3 rounded border cursor-pointer hover:bg-gray-100">
                                <input type="radio"
                                       name="question_{{ $q->id }}"
                                       value="{{ $i }}"
                                       class="h-4 w-4 text-indigo-600"
                                       required>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-6 text-center">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-indigo-700 shadow">
                Soumettre mes réponses
            </button>
        </div>

    </form>
</div>

@endsection
