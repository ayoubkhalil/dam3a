@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border border-rose-100 shadow-sm p-6">
    <h1 class="text-xl font-semibold text-rose-600 mb-4">Connexion</h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
        </div>
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember" class="rounded border-rose-300 text-rose-600">
            <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
        </div>
        <button type="submit" class="w-full bg-rose-600 text-white py-2 rounded-lg font-medium hover:bg-rose-700">Se connecter</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Pas de compte ? <a href="{{ route('register') }}" class="text-rose-600 font-medium">S'inscrire</a></p>
</div>
@endsection
