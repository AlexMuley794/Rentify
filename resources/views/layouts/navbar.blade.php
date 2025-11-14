<!-- Top Navigation Bar -->
<nav class="bg-white dark:bg-gray-800 shadow-md px-4 md:px-6 py-4">
    <div class="flex items-center justify-between">
        <!-- Mobile Menu Toggle -->
        <button id="menu-toggle" class="md:hidden text-gray-600 dark:text-gray-300 hover:text-indigo-600">
            <i class="fas fa-bars text-2xl"></i>
        </button>

        <!-- Center Title -->
        <div class="flex-1 text-center md:text-left md:ml-4">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">
                @yield('page-title', 'Rentify')
            </h1>
        </div>

        <!-- User Dropdown -->
        <div class="flex items-center space-x-4">
            @auth
                <!-- User Info -->
                <div class="hidden md:flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            @if(Auth::user()->role_id === 1)
                                <span class="text-red-600">Administrador</span>
                            @else
                                <span class="text-blue-600">Usuario</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </button>
                </form>
            @else
                <!-- Login Link for Guests -->
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                </a>
            @endauth
        </div>
    </div>
</nav>
