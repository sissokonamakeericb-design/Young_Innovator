<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'Kalan Yoro' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="flex min-h-screen bg-gray-100 text-gray-800 font-sans">

    {{-- Sidebar --}}
    <aside class="w-64 bg-indigo-700 text-white p-6 hidden md:block">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold">🎓 Kalan Yoro</h1>
            <p class="text-sm opacity-90">L'endroit Du Savoir</p>
        </div>

        <nav class="flex flex-col gap-3 text-sm">

            {{-- Toujours accessible --}}
            <a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded hover:bg-indigo-600 transition">Accueil</a>

            {{-- Liens protégés : désactivés si non connecté --}}
            @php $isGuest = !auth()->check(); @endphp

            <a href="{{ $isGuest ? '#' : url('/cours') }}"
               class="px-3 py-2 rounded transition {{ $isGuest ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-600' }}">
                Cours
            </a>

            <a href="{{ $isGuest ? '#' : url('/mes-quizzes') }}"
               class="px-3 py-2 rounded transition {{ $isGuest ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-600' }}">
                Mes Quiz
            </a>

            <a href="{{ $isGuest ? '#' : url('/progression') }}"
               class="px-3 py-2 rounded transition {{ $isGuest ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-600' }}">
                Progression
            </a>

            <a href="{{ $isGuest ? '#' : url('/badges') }}"
               class="px-3 py-2 rounded transition {{ $isGuest ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-600' }}">
                Badges
            </a>

            <a href="{{ $isGuest ? '#' : url('/profil') }}"
               class="px-3 py-2 rounded transition {{ $isGuest ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-600' }}">
                Mon Profil
            </a>

                <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button 
        class="w-full text-left px-3 py-2 rounded hover:bg-indigo-600 transition">
        Déconnexion
    </button>
</form>

            {{-- Toujours accessible --}}
            <a href="{{ url('/support') }}" class="px-3 py-2 rounded hover:bg-indigo-600 transition">Support</a>
    

</form>

        </nav>
    </aside>

    {{-- Contenu principal --}}
    <div class="flex-1 flex flex-col">
        
        {{-- Header simple --}}
        <header class="bg-white shadow p-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold">{{ $title ?? '' }}</h1>

            {{-- Si l'utilisateur n'est pas connecté : avatar invité --}}
            @php
                $user = auth()->user() ?? (object)[
                    'prenom' => 'Utilisateur',
                    'nom' => '',
                    'photo_profil' => null
                ];
            @endphp

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <div class="font-medium">{{ $user->prenom }} {{ $user->nom }}</div>
                    <div class="text-xs text-gray-500">Bonjour </div>
                </div>
                <img src="{{ $user->photo_profil ?? 'https://ui-avatars.com/api/?name='.$user->prenom }}"
                     class="w-10 h-10 rounded-full border-2 border-indigo-500 object-cover" />
            </div>
        </header>

        {{-- Zone où s’affichent tes pages --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>
</body>
</html>
