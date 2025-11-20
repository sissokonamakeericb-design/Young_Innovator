@extends('layouts.dashboard')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Cours</h2>
  <a href="/cours/create" class="bg-green-600 text-white px-4 py-2 rounded">+ Nouveau cours</a>
</div>

<div class="bg-white rounded-lg shadow overflow-auto">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-3 text-left text-sm text-gray-600">ID</th>
        <th class="p-3 text-left text-sm text-gray-600">Titre</th>
        <th class="p-3 text-left text-sm text-gray-600">Catégorie</th>
        <th class="p-3 text-left text-sm text-gray-600">Enseignant</th>
        <th class="p-3 text-center text-sm text-gray-600">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cours as $c)
      <tr class="border-t hover:bg-gray-50">
        <td class="p-3 text-sm">{{ $c->id }}</td>
        <td class="p-3 text-sm">{{ $c->titre }}</td>
        <td class="p-3 text-sm">{{ $c->categorie }}</td>
        <td class="p-3 text-sm">{{ $c->enseignant->prenom ?? 'N/A' }} {{ $c->enseignant->nom ?? '' }}</td>
        <td class="p-3 text-sm text-center">
          <a href="/cours/{{ $c->id }}" class="text-blue-600 hover:underline">Voir</a> |
          <a href="/cours/{{ $c->id }}/edit" class="text-yellow-500 hover:underline">Modifier</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
