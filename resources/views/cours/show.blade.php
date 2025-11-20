@extends('layouts.dashboard')
@section('content')
<div class="bg-white p-6 rounded-xl shadow">
  <div class="flex gap-6">
    <img src="{{ $cours->image ?? 'https://via.placeholder.com/240x140' }}" class="w-64 h-40 object-cover rounded">
    <div>
      <h2 class="text-2xl font-bold">{{ $cours->titre }}</h2>
      <p class="text-sm text-gray-600">{{ $cours->categorie }}</p>
      <p class="mt-3 text-gray-700">{{ $cours->description }}</p>

      <div class="mt-4">
        <a href="/quiz?cours_id={{ $cours->id }}" class="bg-purple-600 text-white px-3 py-2 rounded">Voir les quiz</a>
      </div>
    </div>
  </div>
</div>
@endsection
