@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white">

    {{-- Header --}}
    <header class="flex items-center justify-between p-6">
        <h1 class="text-2xl font-bold tracking-wide">🎓 Kalan Yoro</h1>

        <nav class="hidden md:flex space-x-6 text-lg">
            <a href="{{ route('login') }}" class="hover:text-yellow-300 transition">Connexion</a>
            <a href="{{ route('register') }}" class="hover:text-yellow-300 transition">Inscription</a>
            <a href="#features" class="hover:text-yellow-300 transition">Fonctionnalités</a>
        </nav>
    </header>

    {{-- Section principale --}}
    <div class="flex flex-col items-center justify-center text-center px-6 mt-20">
        <h2 class="text-4xl md:text-6xl font-extrabold leading-tight">
            Apprenez <span class="text-yellow-300">en vous amusant</span>
        </h2>

        <p class="mt-4 text-lg md:text-xl max-w-2xl opacity-90">
            Une plateforme moderne pour apprendre facilement, suivre vos progrès, gagner des badges
            et profiter d'exercices interactifs !
        </p>

        {{-- Boutons --}}
        <div class="mt-8 flex flex-col md:flex-row gap-4">
            <a href="{{ route('register') }}"
               class="bg-yellow-300 text-indigo-800 px-6 py-3 rounded-full font-semibold shadow-lg hover:bg-yellow-400 transition">
               Commencer maintenant 
            </a>

            <a href="{{ route('login') }}"
               class="bg-white bg-opacity-20 backdrop-blur px-6 py-3 rounded-full font-semibold hover:bg-opacity-30 transition">
               Se connecter
            </a>

            {{-- Nouveau bouton pour devenir enseignant --}}
            <a href="{{ route('enseignant.create') }}"
               class="bg-purple-500 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:bg-purple-600 transition">
               Devenir enseignant 
            </a>
        </div>
    </div>

    {{-- Section fonctionnalités --}}
    <section id="features" class="mt-28 p-10 bg-white text-gray-800 rounded-t-3xl shadow-inner">
        <h3 class="text-3xl font-bold text-center mb-10">✨ Fonctionnalités</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="bg-gray-100 rounded-xl p-6 shadow hover:shadow-lg transition">
                <h4 class="text-xl font-bold mb-2">📚 Cours interactifs</h4>
                <p class="text-sm opacity-75">Apprenez facilement grâce à des modules simples et bien structurés.</p>
            </div>

            <div class="bg-gray-100 rounded-xl p-6 shadow hover:shadow-lg transition">
                <h4 class="text-xl font-bold mb-2">🧠 Quiz intelligents</h4>
                <p class="text-sm opacity-75">Testez votre niveau et progressez automatiquement.</p>
            </div>

            <div class="bg-gray-100 rounded-xl p-6 shadow hover:shadow-lg transition">
                <h4 class="text-xl font-bold mb-2">🏅 Badges & progression</h4>
                <p class="text-sm opacity-75">Gagnez des badges en réalisant vos objectifs.</p>
            </div>

        </div>
    </section>

</div>
@endsection
