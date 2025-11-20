@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Modifier mon mot de passe</h1>
        <p class="text-gray-500 mt-1">Assurez la sécurité de votre compte</p>
    </div>

    <!-- Message succès -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire -->
    <form action="{{ route('profil.password.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Mot de passe actuel -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Mot de passe actuel</label>
            <input type="password" name="current_password" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            @error('current_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nouveau mot de passe</label>
            <input type="password" name="password" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Confirmer le mot de passe -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
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
