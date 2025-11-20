@extends('layouts.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">

    <!-- Header Support -->
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-blue-600 text-white p-3 rounded-full shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636a9 9 0 11-12.728 0m12.728 0L12 12m6.364-6.364L12 12m0 0l-6.364-6.364" />
            </svg>
        </div>

        <div>
            <h1 class="text-3xl font-bold text-gray-800">Support & Assistance</h1>
            <p class="text-gray-500 text-sm">Nous sommes disponibles 24h/24 pour vous aider.</p>
        </div>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            <strong>✔ Succès :</strong> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <strong>⚠ Erreur(s) :</strong>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire Support -->
    <form action="{{ route('support.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Sujet -->
        <div>
            <label class="font-semibold block mb-1">Sujet du problème</label>
            <input type="text" name="sujet"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400"
                   placeholder="Ex : Impossible de me connecter à mon compte">
        </div>

        <!-- Catégorie -->
        <div>
            <label class="font-semibold block mb-1">Catégorie</label>
            <select name="categorie"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-400">
                <option value="">Sélectionnez une catégorie</option>
                <option value="Technique">Problème technique</option>
                <option value="Compte">Compte / Profil</option>
                <option value="Cours">Cours & Contenu</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <!-- Urgence -->
        <div>
            <label class="font-semibold block mb-1">Niveau d'urgence</label>
            <select name="urgence"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-red-400">
                <option value="Faible">Faible</option>
                <option value="Moyenne">Moyenne</option>
                <option value="Élevée">Élevée</option>
                <option value="Critique">Critique </option>
            </select>
        </div>

        <!-- Message -->
        <div>
            <label class="font-semibold block mb-1">Message détaillé</label>
            <textarea name="message" rows="6"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400"
                placeholder="Expliquez votre problème..."></textarea>
        </div>

        <!-- Fichier -->
        <div>
            <label class="font-semibold block mb-1">Ajouter une capture d’écran (optionnel)</label>
            <input type="file" name="fichier"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
        </div>

        <!-- Bouton -->
        <div class="text-right">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-full shadow-lg 
                       hover:bg-blue-700 hover:scale-[1.03] transition-all duration-300">
                Envoyer la demande
            </button>
        </div>
    </form>

</div>
@endsection
