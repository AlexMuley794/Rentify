<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-indigo-900 text-white p-6 overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 fixed md:static h-full z-50 flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-2">
            <i class="fas fa-building text-2xl text-indigo-300"></i>
            <span class="text-2xl font-bold">Rentify</span>
        </div>
        <button id="close-sidebar" class="md:hidden text-white hover:text-gray-300">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- User Info (Top) -->
    <div class="mb-6 p-4 bg-indigo-800 rounded-xl border border-indigo-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-lg font-bold shadow-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-indigo-300 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="space-y-2 flex-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white shadow-md' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} transition duration-200">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Properties -->
        <a href="{{ route('properties.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('properties.*') ? 'bg-indigo-700 text-white shadow-md' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} transition duration-200">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Propiedades</span>
        </a>

        <!-- Tenants -->
        <a href="{{ route('tenants.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('tenants.*') ? 'bg-indigo-700 text-white shadow-md' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} transition duration-200">
            <i class="fas fa-users w-5 text-center"></i>
            <span class="font-medium">Inquilinos</span>
        </a>

        <!-- Reservations -->
        <a href="{{ route('reservations.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('reservations.*') ? 'bg-indigo-700 text-white shadow-md' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} transition duration-200">
            <i class="fas fa-calendar-alt w-5 text-center"></i>
            <span class="font-medium">Reservas</span>
        </a>

        <!-- Transactions -->
        <a href="{{ route('transactions.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('transactions.*') ? 'bg-indigo-700 text-white shadow-md' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} transition duration-200">
            <i class="fas fa-exchange-alt w-5 text-center"></i>
            <span class="font-medium">Transacciones</span>
        </a>
    </nav>

    <!-- Bottom Actions -->
    <div class="mt-auto pt-6 border-t border-indigo-800 space-y-2">
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Configuración</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded-lg text-red-300 hover:bg-red-900/30 hover:text-red-200 transition">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</aside>
