@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Mon Profil</h1>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center gap-6">
        <img src="{{ $user->photo_profil ?? 'https://ui-avatars.com/api/?name='.$user->prenom }}" 
             class="w-24 h-24 rounded-full border-2 border-indigo-500 object-cover">

        <div>
            <p><span class="font-semibold">Prénom:</span> {{ $user->prenom }}</p>
            <p><span class="font-semibold">Nom:</span> {{ $user->nom }}</p>
            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
            <p><span class="font-semibold">Rôle:</span> {{ ucfirst($user->role) }}</p>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('profil.edit') }}" 
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Modifier mon profil
        </a>

        <a href="{{ route('profil.password') }}" 
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Changer le mot de passe
        </a>
    </div>
</div>
@endsection
