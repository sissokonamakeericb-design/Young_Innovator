@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Mes Badges</h1>

    @if($badges->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            Vous n'avez encore obtenu aucun badge.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($badges as $badge)
                <div class="bg-white shadow rounded-lg p-5 text-center border hover:shadow-lg transition duration-300">
                    <img src="{{ $badge->icone }}" 
                         alt="Icône badge" 
                         class="w-20 h-20 mx-auto mb-4">

                    <h3 class="text-xl font-semibold">{{ $badge->nom }}</h3>
                    <p class="text-gray-600 mt-2">{{ $badge->description }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
