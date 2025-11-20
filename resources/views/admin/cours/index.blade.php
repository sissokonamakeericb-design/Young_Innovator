@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tous les Cours</h2>

<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-50">
            <th class="p-4">ID</th>
            <th class="p-4">Titre</th>
            <th class="p-4">Enseignant</th>
            <th class="p-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cours as $c)
        <tr class="border-t hover:bg-gray-50">
            <td class="p-4">{{ $c->id }}</td>
            <td class="p-4">{{ $c->titre }}</td>
            <td class="p-4">{{ $c->enseignant->prenom ?? '-' }}</td>
            <td class="p-4">
                <form action="{{ route('admin.cours.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce cours ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
