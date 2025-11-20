{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-8 text-indigo-700">📊 Dashboard Administrateur</h1>

    {{-- Cartes statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Étudiants inscrits</h2>
            <p class="mt-3 text-3xl font-bold text-indigo-600">{{ $etudiantsCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Enseignants inscrits</h2>
            <p class="mt-3 text-3xl font-bold text-indigo-600">{{ $enseignantsCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Cours disponibles</h2>
            <p class="mt-3 text-3xl font-bold text-indigo-600">{{ $coursCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Quiz disponibles</h2>
            <p class="mt-3 text-3xl font-bold text-indigo-600">{{ $quizCount }}</p>
        </div>

    </div>

    {{-- Utilisateurs récents --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">👥 Utilisateurs récents</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Rôle</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Inscrit le</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="px-6 py-4">{{ $user->prenom }} {{ $user->nom }}</td>
                        <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 flex gap-2">

                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                               ✏️ Modifier
                            </a>

                            <form action="{{ route('admin.users.toggleSuspension', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    {{ $user->is_suspended ? '🔓 Réactiver' : '⏸️ Suspendre' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 📚 Tous les cours (ADMIN) --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">📘 Tous les cours</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Titre</th>
                        <th class="px-6 py-3">Enseignant</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Cours::with('enseignant')->get() as $c)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4">{{ $c->id }}</td>
                        <td class="px-6 py-4">{{ $c->titre }}</td>
                        <td class="px-6 py-4">{{ $c->enseignant->prenom ?? '-' }}</td>
                        <td class="px-6 py-4">

                            <form action="{{ route('admin.cours.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Supprimer ce cours ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 📝 Tous les quiz (ADMIN) --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">📝 Tous les quiz</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Titre</th>
                        <th class="px-6 py-3">Cours</th>
                        <th class="px-6 py-3">Enseignant</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Quiz::with('cours', 'enseignant')->get() as $q)
                    <tr class="hover:bg-purple-50">
                        <td class="px-6 py-4">{{ $q->id }}</td>
                        <td class="px-6 py-4">{{ $q->titre }}</td>
                        <td class="px-6 py-4">{{ $q->cours->titre ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $q->enseignant->prenom ?? '-' }}</td>
                        <td class="px-6 py-4">

                            <form action="{{ route('admin.quiz.destroy', $q->id) }}" method="POST" onsubmit="return confirm('Supprimer ce quiz ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Demandes enseignants --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">📩 Demandes des enseignants</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3">Enseignant</th>
                        <th class="px-6 py-3">Spécialité</th>
                        <th class="px-6 py-3">Niveau</th>
                        <th class="px-6 py-3">CV</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enseignantRequests as $request)
                    <tr class="hover:bg-indigo-50">
                        <td class="px-6 py-4">{{ $request->user->prenom }} {{ $request->user->nom }}</td>
                        <td class="px-6 py-4">{{ $request->specialite }}</td>
                        <td class="px-6 py-4">{{ $request->niveau_etude }}</td>
                        <td class="px-6 py-4">
                            @if($request->cv)
                                <a href="{{ asset('storage/' . $request->cv) }}" target="_blank" class="text-blue-600 hover:underline">Voir CV</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $request->description }}</td>
                        <td class="px-6 py-4">
                            @if($request->status == 'en_attente')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">En attente</span>
                            @elseif($request->status == 'accepte')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full">Accepté</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">Refusé</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            @if($request->status == 'en_attente')
                                <form action="{{ route('admin.requests.approve', $request->id) }}" method="POST">@csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded">Accepter</button>
                                </form>
                                <form action="{{ route('admin.requests.reject', $request->id) }}" method="POST">@csrf
                                    <button class="bg-red-600 text-white px-3 py-1 rounded">Refuser</button>
                                </form>
                            @else
                                <span class="text-gray-600 text-sm italic">Action impossible</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
