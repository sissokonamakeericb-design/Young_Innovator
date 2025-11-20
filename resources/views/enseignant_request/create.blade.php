@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 to-indigo-50 py-12 px-4">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-lg p-10 transform transition duration-500 hover:scale-105">
        <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Devenir Enseignant</h1>

        {{-- Messages --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('enseignant.request') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Spécialité</label>
                <input type="text" name="specialite" placeholder="Ex: Informatique" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Niveau d'étude</label>
                <input type="text" name="niveau_etude" placeholder="Ex: Master" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Parlez-nous de votre expérience..." 
                          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">CV (PDF, DOC, DOCX)</label>
                <input type="file" name="cv" class="w-full text-gray-600">
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-600 text-white p-3 rounded-xl font-semibold text-lg hover:bg-indigo-700 transition transform hover:-translate-y-0.5">
                Envoyer la demande
            </button>
        </form>

        <p class="mt-6 text-center text-gray-500 text-sm">
            Tous vos renseignements seront traités confidentiellement.
        </p>
    </div>
</div>
@endsection
