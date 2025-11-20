@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
    <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl w-full max-w-md border border-indigo-100">
        
        <!-- En-tête -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-indigo-700 mb-2">Inscription </h1>
            <p class="text-gray-500 text-sm">Rejoignez la plateforme kalan yoro 🚀</p>
        </div>

        <!-- Messages d’erreur -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-2">Prénom</label>
                <input type="text" name="prenom" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Ex : Amadou" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Nom</label>
                <input type="text" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Ex : Diarra" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Téléphone</label>
                <input type="text" name="telephone" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="+223 76 00 00 00" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Adresse email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Ex : etudiant@mail.com" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="********" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="********" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 active:scale-95 transition-transform duration-150">
                S'inscrire
            </button>
        </form>

        <!-- Pied -->
        <p class="mt-6 text-center text-gray-600">
            Déjà un compte ? 
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                Se connecter
            </a>
        </p>
    </div>
</div>
@endsection
