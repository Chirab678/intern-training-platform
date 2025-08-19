<?php
// resources/views/layouts/app.blade.php
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StageForce') }} - @yield('title', 'Formation Professionnelle')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div id="app">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <span class="text-2xl font-bold text-primary-600">🎓 StageForce</span>
                        </a>
                    </div>

                    @auth
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-sm font-medium">
                                @if(auth()->user()->isAdmin())
                                    Admin
                                @elseif(auth()->user()->isManager())
                                    Manager
                                @elseif(auth()->user()->isIntern())
                                    Stagiaire
                                @else
                                    Entrepreneur
                                @endif
                            </span>
                            <span class="text-sm text-gray-600">Mois {{ auth()->user()->current_month }}/3</span>
                        </div>

                        <div class="relative">
                            <button type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" id="user-menu-button">
                                <span class="sr-only">Ouvrir menu utilisateur</span>
                                <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="ml-2 text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-gray-400"></i>
                            </button>

                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="user-menu">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i> Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Menu principal -->
        @auth
        <div class="bg-primary-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-4 text-sm font-medium text-white hover:text-primary-200 {{ request()->routeIs('dashboard') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                    </a>
                    <a href="{{ route('modules.index') }}" class="flex items-center px-3 py-4 text-sm font-medium text-white hover:text-primary-200 {{ request()->routeIs('modules.*') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-book mr-2"></i> Modules
                    </a>
                    <a href="#" class="flex items-center px-3 py-4 text-sm font-medium text-white hover:text-primary-200">
                        <i class="fas fa-chart-line mr-2"></i> Progression
                    </a>
                </div>
            </div>
        </div>
        @endauth

        <!-- Contenu principal -->
        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Messages Flash -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Toggle user menu
        document.getElementById('user-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('user-menu');
            menu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const button = document.getElementById('user-menu-button');
            const menu = document.getElementById('user-menu');
            
            if (button && menu && !button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>