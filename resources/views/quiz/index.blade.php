@extends('layouts.dashboard')
@section('content')

<div class="flex flex-col sm:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-indigo-700 mb-4 sm:mb-0">Quiz</h2>
  <a href="/quiz/create" class="bg-purple-600 hover:bg-purple-700 transition text-white px-5 py-2 rounded-lg shadow-md font-medium">
    + Nouveau quiz
  </a>
</div>

<div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @foreach($quizzes as $q)
      <tr class="hover:bg-indigo-50 transition duration-200">
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $q->id }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $q->titre }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $q->cours->titre ?? 'N/A' }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
          <a href="/quiz/{{ $q->id }}" class="text-blue-600 hover:underline font-semibold">Voir</a>
          <span class="mx-2 text-gray-300">|</span>
          <a href="/quiz/{{ $q->id }}/edit" class="text-yellow-500 hover:underline font-semibold">Modifier</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @if($quizzes->isEmpty())
    <p class="p-4 text-gray-500 italic">Aucun quiz disponible pour le moment.</p>
  @endif
</div>

@endsection
