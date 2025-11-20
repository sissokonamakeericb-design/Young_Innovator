@extends('layouts.dashboard')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Modifier mon profil</h1>
        <p class="text-gray-500 mt-1">Mettez à jour vos informations personnelles</p>
    </div>

    <!-- Message succès -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire -->
    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Prénom -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            @error('prenom') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Nom -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            @error('nom') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Photo de profil -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Photo de profil</label>
            <input type="file" name="photo_profil" class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @if($user->photo_profil)
                <img src="{{ $user->photo_profil }}" class="w-28 h-28 rounded-full mt-3 border-2 border-gray-200 object-cover">
            @endif
            @error('photo_profil') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('profil') }}" 
               class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
