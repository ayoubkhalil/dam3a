@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <h1 class="text-3xl font-bold text-rose-600 mb-4">
        Bienvenue sur Dam3a
    </h1>

    <p class="text-gray-600 mb-6">
        Soutien anti-harcèlement et bien-être pour les ados en Tunisie.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="#" class="p-6 bg-white rounded-xl shadow hover:shadow-md">
            <h2 class="font-semibold text-lg">Discussion de soutien</h2>
            <p class="text-sm text-gray-500 mt-2">
                Parle à l’assistant bienveillant.
            </p>
        </a>

        <a href="#" class="p-6 bg-white rounded-xl shadow hover:shadow-md">
            <h2 class="font-semibold text-lg">Analyser un incident</h2>
            <p class="text-sm text-gray-500 mt-2">
                Décris ce qui s’est passé et obtiens un rapport.
            </p>
        </a>

        <a href="#" class="p-6 bg-white rounded-xl shadow hover:shadow-md">
            <h2 class="font-semibold text-lg">Centre de sécurité</h2>
            <p class="text-sm text-gray-500 mt-2">
                Numéros d’urgence et FAQ parents.
            </p>
        </a>
    </div>
@endsection
