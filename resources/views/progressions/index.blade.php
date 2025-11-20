@extends('layouts.dashboard')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Progressions</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-auto">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-3 text-left text-sm text-gray-600">Étudiant</th>
        <th class="p-3 text-left text-sm text-gray-600">Cours</th>
        <th class="p-3 text-left text-sm text-gray-600">Points</th>
        <th class="p-3 text-left text-sm text-gray-600">Quiz terminés</th>
        <th class="p-3 text-left text-sm text-gray-600">Mise à jour</th>
      </tr>
    </thead>
    <tbody>
      @foreach($progressions as $p)
      <tr class="border-t hover:bg-gray-50">
        <td class="p-3 text-sm">{{ $p->user->prenom ?? $p->user->email }}</td>
        <td class="p-3 text-sm">{{ $p->cours->titre ?? 'N/A' }}</td>
        <td class="p-3 text-sm">{{ $p->points }}</td>
        <td class="p-3 text-sm">{{ $p->quizzes_termine }}</td>
        <td class="p-3 text-sm">{{ $p->updated_at->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
