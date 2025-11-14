<nav x-data="{ open: false, userMenuOpen: false }" class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-2 group-hover:shadow-lg transition duration-300">
                            <i class="fas fa-home text-white text-lg"></i>
                        </div>
                        <span class="font-bold text-xl text-gray-900 dark:text-white">Rentify</span>
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} transition duration-200">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('properties.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('properties.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} transition duration-200">
                    <i class="fas fa-building mr-2"></i> Propiedades
                </a>
                <a href="{{ route('tenants.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tenants.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} transition duration-200">
                    <i class="fas fa-users mr-2"></i> Inquilinos
                </a>
                <a href="{{ route('reservations.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('reservations.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} transition duration-200">
                    <i class="fas fa-calendar-check mr-2"></i> Reservas
                </a>
                <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('transactions.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} transition duration-200">
                    <i class="fas fa-exchange-alt mr-2"></i> Transacciones
                </a>
            </div>

            <!-- Desktop User Menu -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                <div class="relative" @click.away="userMenuOpen = false">
                    <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200 group">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': userMenuOpen }"></i>
                    </button>

                    <!-- User Dropdown Menu -->
                    <div x-show="userMenuOpen" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 border border-gray-200 dark:border-gray-700">
                        <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-user mr-2"></i> Mi Perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                    </a>
                </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button @click="open = !open" class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                <svg class="h-6 w-6" :class="{ 'hidden': open, 'block': !open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="h-6 w-6" :class="{ 'block': open, 'hidden': !open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" x-transition class="md:hidden bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-200">
                <i class="fas fa-chart-line mr-2"></i> Dashboard
            </a>
            <a href="{{ route('properties.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('properties.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-200">
                <i class="fas fa-building mr-2"></i> Propiedades
            </a>
            <a href="{{ route('tenants.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('tenants.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-200">
                <i class="fas fa-users mr-2"></i> Inquilinos
            </a>
            <a href="{{ route('reservations.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('reservations.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-200">
                <i class="fas fa-calendar-check mr-2"></i> Reservas
            </a>
            <a href="{{ route('transactions.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('transactions.*') ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-200">
                <i class="fas fa-exchange-alt mr-2"></i> Transacciones
            </a>
        </div>

        <!-- Mobile User Menu -->
        <div class="border-t border-gray-200 dark:border-gray-700 px-2 pt-3 pb-3 space-y-1">
            @auth
            <div class="px-3 py-2">
                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                <i class="fas fa-user mr-2"></i> Mi Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                </button>
            </form>
            @else
            <div class="px-3 py-2">
                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Acceso de Usuarios</p>
            </div>
            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-base font-medium bg-blue-600 text-white hover:bg-blue-700 transition duration-200">
                <i class="fas fa-user-plus mr-2"></i> Registrarse
            </a>
            @endauth
        </div>
    </div>
</nav>
