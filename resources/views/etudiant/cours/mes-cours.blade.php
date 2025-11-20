@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto mt-8">

    <h2 class="text-3xl font-bold text-indigo-700 mb-6">Tous les cours disponibles</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($cours->isEmpty())
        <p class="text-gray-500 italic">Aucun cours disponible pour le moment.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cours as $c)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="p-6">
                        <h5 class="text-xl font-semibold text-indigo-800 mb-2">{{ $c->titre }}</h5>
                        <p class="text-gray-600 mb-4">{{ Str::limit($c->description, 120) }}</p>

                        {{-- Badge si déjà inscrit --}}
                        @php
                            $estInscrit = $coursSuivis->contains($c->id);
                        @endphp

                        @if($estInscrit)
                            <span class="inline-block bg-indigo-200 text-indigo-800 text-xs px-2 py-1 rounded-full mb-2">Inscrit ✅</span>
                        @endif

                        <div class="mt-4">
                            @if($estInscrit)
                                <form action="{{ route('cours.retirer', $c->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition duration-300">
                                        Se désinscrire
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('cours.suivre', $c->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition duration-300">
                                        S'inscrire
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
