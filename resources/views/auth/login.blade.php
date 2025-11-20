@extends('layouts.dashboard')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 transform transition duration-500 hover:scale-[1.02] hover:shadow-blue-300/50">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="h-16 w-16 bg-blue-600 text-white flex items-center justify-center rounded-full shadow-md text-2xl font-bold">
                    🔒
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Bienvenue</h2>
            <p class="text-gray-500 text-sm mt-1">Connectez-vous à votre espace personnel</p>
        </div>

        {{-- Messages d'erreur --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 border border-red-200">
                <ul class="text-sm list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Adresse Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" placeholder="ex: aminata@test.com" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" placeholder="********" required>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                    <span class="ml-2">Se souvenir de moi</span>
                </label>
                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                Se connecter
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">Créer un compte</a>
        </p>
    </div>
</div>
@endsection
