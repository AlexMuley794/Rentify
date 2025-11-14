<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-indigo-900 text-white p-6 overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 fixed md:static h-full z-50">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-2">
            <i class="fas fa-building text-2xl text-indigo-300"></i>
            <span class="text-2xl font-bold">Rentify</span>
        </div>
        <button id="close-sidebar" class="md:hidden text-white hover:text-gray-300">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="space-y-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg {{ Route::currentRouteName() == 'dashboard' ? 'bg-indigo-700' : 'hover:bg-indigo-800' }} transition">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <!-- Properties -->
        <a href="{{ route('properties.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg {{ str_contains(Route::currentRouteName(), 'properties') ? 'bg-indigo-700' : 'hover:bg-indigo-800' }} transition">
            <i class="fas fa-home"></i>
            <span>Propiedades</span>
        </a>

        <!-- Tenants -->
        <a href="{{ route('tenants.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg {{ str_contains(Route::currentRouteName(), 'tenants') ? 'bg-indigo-700' : 'hover:bg-indigo-800' }} transition">
            <i class="fas fa-users"></i>
            <span>Inquilinos</span>
        </a>

        <!-- Reservations -->
        <a href="{{ route('reservations.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg {{ str_contains(Route::currentRouteName(), 'reservations') ? 'bg-indigo-700' : 'hover:bg-indigo-800' }} transition">
            <i class="fas fa-calendar-alt"></i>
            <span>Reservas</span>
        </a>

        <!-- Transactions -->
        <a href="{{ route('transactions.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg {{ str_contains(Route::currentRouteName(), 'transactions') ? 'bg-indigo-700' : 'hover:bg-indigo-800' }} transition">
            <i class="fas fa-exchange-alt"></i>
            <span>Transacciones</span>
        </a>
    </nav>

    <hr class="my-6 border-indigo-700">

    <!-- User Section -->
    <div class="space-y-3">
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-indigo-800 transition">
            <i class="fas fa-user-circle"></i>
            <span>Perfil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-red-700 transition text-red-300 hover:text-white">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</aside>
