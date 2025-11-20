@extends('layouts.dashboard')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Questions</h2>
    <a href="/questions/create" class="bg-green-600 text-white px-4 py-2 rounded">+ Nouvelle question</a>
</div>

<div class="bg-white rounded-lg shadow overflow-auto">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 text-left text-sm text-gray-600">ID</th>
                <th class="p-3 text-left text-sm text-gray-600">Question</th>
                <th class="p-3 text-left text-sm text-gray-600">Quiz</th>
                <th class="p-3 text-center text-sm text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $q)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 text-sm">{{ $q->id }}</td>
                <td class="p-3 text-sm">{{ \Illuminate\Support\Str::limit($q->question ?? $q->intitule, 80) }}</td>
                <td class="p-3 text-sm">{{ $q->quiz->titre ?? 'N/A' }}</td>
                <td class="p-3 text-sm text-center">
                    <a href="/questions/{{ $q->id }}/edit" class="text-yellow-500 hover:underline">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection