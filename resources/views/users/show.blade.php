@extends('layouts.dashboard')
@section('content')
<div class="bg-white p-6 rounded-xl shadow">
  <div class="flex items-center gap-6">
    <img src="{{ $user->photo_profil ?? 'https://ui-avatars.com/api/?name='.$user->prenom }}" class="w-24 h-24 rounded-full object-cover">
    <div>
      <h2 class="text-2xl font-bold">{{ $user->prenom }} {{ $user->nom }}</h2>
      <p class="text-sm text-gray-500">{{ $user->email }}</p>
      <p class="text-sm text-gray-500">Rôle : {{ ucfirst($user->role) }}</p>
    </div>
  </div>

  <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-gray-50 p-4 rounded">
      <h3 class="font-semibold mb-2">Cours inscrits</h3>
      <ul class="list-disc ml-5 text-sm">
        @foreach($user->coursSuivis as $c)
          <li>{{ $c->titre }}</li>
        @endforeach
      </ul>
    </div>
    <div class="bg-gray-50 p-4 rounded">
      <h3 class="font-semibold mb-2">Badges</h3>
      <ul class="list-disc ml-5 text-sm">
        @foreach($user->badges as $b)
          <li>{{ $b->nom }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
