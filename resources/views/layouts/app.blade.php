<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Rentify - Gestión de Alquileres')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        @auth
            <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
                <!-- Sidebar -->
                @include('layouts.sidebar')

                <!-- Main Content -->
                <div class="flex-1 overflow-auto">
                    <!-- Top Navigation -->
                    @include('layouts.navbar')

                    <!-- Page Content -->
                    <main class="p-4 md:p-6">
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                                <h3 class="font-bold mb-2">Errores de validación:</h3>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        @yield('content')
                    </main>
                </div>
            </div>
        @else
            <!-- Navigation for non-authenticated users -->
            @include('layouts.navigation')
            
            <main>
                @yield('content')
            </main>
        @endauth

        <script>
            // Toggle sidebar en móviles
            document.getElementById('menu-toggle')?.addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('-translate-x-full');
            });

            document.getElementById('close-sidebar')?.addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('-translate-x-full');
            });
        </script>

        @yield('scripts')
    </body>
</html>
