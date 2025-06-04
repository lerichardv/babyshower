<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lista de Deseos') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <!-- Sidebar Navigation -->
            <aside class="fixed inset-y-0 left-0 min-w-[300px] bg-white shadow-lg h-screen overflow-y-auto">
                <div class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="px-6 py-6 border-b border-pink-100 bg-gradient-to-r from-pink-500 to-pink-400">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-2xl font-bold text-pink-50">Lista de Deseos</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex-1 px-4 py-6 space-y-2">
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="{{ request()->routeIs('dashboard') ? 'bg-pink-50 text-pink-700 border-pink-500' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-700' }}
                                      flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Panel de Control
                            </a>
                        @endauth
                    </nav>

                    <!-- User Menu -->
                    @auth
                        <div class="border-t border-pink-100 bg-pink-50 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-400 to-pink-500 flex items-center justify-center">
                                        <span class="text-white font-medium text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="text-xs font-medium text-pink-600 hover:text-pink-800 transition-colors">
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="border-t border-pink-100 p-4">
                            <a href="{{ route('login') }}"
                               class="flex items-center text-sm font-medium text-pink-600 hover:text-pink-800 transition-colors">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Iniciar Sesión Admin
                            </a>
                        </div>
                    @endauth
                </div>
            </aside>

            <!-- Main Content -->
            <div class="pl-[300px]">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow-sm">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ $header }}
                            </h1>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
