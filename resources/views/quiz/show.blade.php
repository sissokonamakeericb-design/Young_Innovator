@extends('layouts.dashboard')
@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold">{{ $quiz->titre }}</h2>
    <p class="text-sm text-gray-500">{{ $quiz->description }}</p>

    <div class="mt-6">
        <a href="/questions?quiz_id={{ $quiz->id }}" class="bg-indigo-600 text-white px-3 py-2 rounded">Voir les questions</a>
        <a href="/questions/create?quiz_id={{ $quiz->id }}" class="ml-2 bg-green-600 text-white px-3 py-2 rounded">Ajouter une question</a>
    </div>
</div>
@endsection