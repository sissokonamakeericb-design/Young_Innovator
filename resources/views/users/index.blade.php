@extends('layouts.dashboard')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Utilisateurs</h2>
    <a href="/users/create" class="bg-blue-600 text-white px-4 py-2 rounded">+ Nouvel utilisateur</a>
</div>

<div class="bg-white rounded-lg shadow overflow-auto">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 text-left text-sm text-gray-600">ID</th>
                <th class="p-3 text-left text-sm text-gray-600">Profil</th>
                <th class="p-3 text-left text-sm text-gray-600">Email</th>
                <th class="p-3 text-left text-sm text-gray-600">Rôle</th>
                <th class="p-3 text-center text-sm text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 text-sm">{{ $u->id }}</td>
                <td class="p-3 text-sm flex items-center gap-3">
                    <img src="{{ $u->photo_profil ?? 'https://ui-avatars.com/api/?name='.$u->prenom }}" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <div class="font-medium">{{ $u->prenom }} {{ $u->nom }}</div>
                        <div class="text-xs text-gray-500">{{ $u->telephone }}</div>
                    </div>
                </td>
                <td class="p-3 text-sm">{{ $u->email }}</td>
                <td class="p-3 text-sm">{{ ucfirst($u->role) }}</td>
                <td class="p-3 text-sm text-center">
                    <a href="/users/{{ $u->id }}" class="text-blue-600 hover:underline mr-2">Voir</a>
                    <a href="/users/{{ $u->id }}/edit" class="text-yellow-500 hover:underline mr-2">Modifier</a>
                    <form action="/users/{{ $u->id }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection