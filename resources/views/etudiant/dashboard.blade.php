@extends('layouts.dashboard')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-bold mb-8 text-indigo-700">Bienvenue, {{ $user->prenom }} ! 🎓</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Cours suivis --}}
        <div class="bg-gradient-to-r from-indigo-100 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
            <h3 class="font-semibold mb-4 text-indigo-800 text-lg">Cours suivis ({{ $coursSuivis->count() }})</h3>

            <ul class="text-gray-700 text-sm mb-6 space-y-1">
                @forelse($coursSuivis as $c)
                    <li class="bg-indigo-200 px-3 py-1 rounded">{{ $c->titre }}</li>
                @empty
                    <li class="text-gray-400 italic">Aucun cours suivi</li>
                @endforelse
            </ul>

            <a href="{{ url('/cours') }}" 
               class="inline-block bg-indigo-600 text-white font-semibold px-5 py-2 rounded-full hover:bg-indigo-700 transition duration-300">
               Voir tous les cours
            </a>
        </div>

        {{-- Badges --}}
        <div class="bg-gradient-to-r from-green-100 to-green-50 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
            <h3 class="font-semibold mb-4 text-green-800 text-lg">Badges ({{ $badges->count() }})</h3>

            <ul class="text-gray-700 text-sm mb-6 space-y-1">
                @forelse($badges as $b)
                    <li class="bg-green-200 px-3 py-1 rounded inline-block">{{ $b->nom }}</li>
                @empty
                    <li class="text-gray-400 italic">Aucun badge</li>
                @endforelse
            </ul>

          <a href="{{ url('/badges') }}"
   class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold px-6 py-2.5 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">
    
    <!-- Icône badge -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
         fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m2 9l-3.24-1.94a2 2 0 00-2.04 0L8 19l.8-3.59a2 2 0 00-.58-1.86L5 11l3.76-.55a2 2 0 001.51-1.09L12 5l1.73 3.36a2 2 0 001.51 1.09L19 11l-3.22 2.55a2 2 0 00-.58 1.86L16 19z"/>
    </svg>

    Voir mes badges
</a>

        </div>

        {{-- Progressions --}}
        <div class="bg-gradient-to-r from-yellow-100 to-yellow-50 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
            <h3 class="font-semibold mb-4 text-yellow-800 text-lg">Progressions</h3>

            <ul class="text-gray-700 text-sm mb-6 space-y-1">
                @forelse($progressions as $p)
                    <li class="bg-yellow-200 px-3 py-1 rounded">
                        {{ $p->cours->titre ?? 'Cours supprimé' }} : {{ $p->pourcentage ?? 0 }}%
                    </li>
                @empty
                    <li class="text-gray-400 italic">Aucune progression</li>
                @endforelse
            </ul>

            <a href="{{ url('/progression') }}" 
               class="inline-block bg-yellow-600 text-white font-semibold px-5 py-2 rounded-full hover:bg-yellow-700 transition duration-300">
               Voir ma progression
            </a>
        </div>

    </div>
</div>
@endsection
