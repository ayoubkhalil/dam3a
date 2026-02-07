@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border border-rose-100 shadow-sm p-6">
    <h1 class="text-xl font-semibold text-rose-600 mb-4">Inscription</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
        </div>
        <button type="submit" class="w-full bg-rose-600 text-white py-2 rounded-lg font-medium hover:bg-rose-700">S'inscrire</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Déjà un compte ? <a href="{{ route('login') }}" class="text-rose-600 font-medium">Se connecter</a></p>
</div>
@endsection
