<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dam3a') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-rose-50 font-sans antialiased text-gray-900">
    <nav class="bg-white/90 backdrop-blur border-b border-rose-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 flex items-center justify-between h-14">
            <a href="{{ url('/') }}" class="font-semibold text-rose-600 text-lg">Dam3a</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('learn.index') }}" class="text-sm text-gray-600 hover:text-rose-600">Compétences</a>
                <a href="{{ route('safety.index') }}" class="text-sm text-gray-600 hover:text-rose-600">Centre de sécurité</a>
                <a href="{{ route('communities.index') }}" class="text-sm text-gray-600 hover:text-rose-600">Communautés</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-rose-600">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-rose-600 font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="text-sm bg-rose-600 text-white px-3 py-1.5 rounded-lg hover:bg-rose-700">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-rose-100 text-rose-800 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg text-sm">{{ session('error') }}</div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
