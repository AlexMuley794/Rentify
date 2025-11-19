@extends('layouts.app')

@section('title', 'Dashboard - Rentify')
@section('page-title', 'Panel de Control')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Bienvenido, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Aquí está tu resumen de negocio</p>
        </div>
        <a href="{{ route('properties.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-semibold shadow-lg">
            <i class="fas fa-plus mr-2"></i> Nueva Propiedad
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Properties -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Propiedades Totales</p>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalProperties }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900 dark:to-blue-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-home text-blue-600 dark:text-blue-300 text-3xl"></i>
                </div>
            </div>
            <a href="{{ route('properties.index') }}" class="mt-4 text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver todas →</a>
        </div>

        <!-- Available Properties -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Disponibles</p>
                    <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $availableProperties }}</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-50 dark:from-green-900 dark:to-green-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="text-green-600 font-semibold">{{ round(($availableProperties / max($totalProperties, 1)) * 100) }}%</span> disponibilidad
            </div>
        </div>

        <!-- Occupied Properties -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Ocupadas</p>
                    <p class="text-4xl font-bold text-orange-600 dark:text-orange-400 mt-2">{{ $occupiedProperties }}</p>
                </div>
                <div class="bg-gradient-to-br from-orange-100 to-orange-50 dark:from-orange-900 dark:to-orange-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-door-open text-orange-600 dark:text-orange-300 text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="text-orange-600 font-semibold">{{ round(($occupiedProperties / max($totalProperties, 1)) * 100) }}%</span> ocupación
            </div>
        </div>

        <!-- Total Tenants -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Inquilinos</p>
                    <p class="text-4xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $totalTenants }}</p>
                </div>
                <div class="bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900 dark:to-purple-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users text-purple-600 dark:text-purple-300 text-3xl"></i>
                </div>
            </div>
            <a href="{{ route('tenants.index') }}" class="mt-4 text-purple-600 hover:text-purple-700 text-sm font-semibold">Ver todos →</a>
        </div>
    </div>

    <!-- Financial Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Income -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Ingresos Totales</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">€{{ number_format($income, 2, ',', '.') }}</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-50 dark:from-green-900 dark:to-green-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-arrow-up text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">Desde el inicio</p>
        </div>

        <!-- Expenses -->
        <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wide">Gastos Totales</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">€{{ number_format($expenses, 2, ',', '.') }}</p>
                </div>
                <div class="bg-gradient-to-br from-red-100 to-red-50 dark:from-red-900 dark:to-red-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-arrow-down text-red-600 dark:text-red-300 text-2xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">Desde el inicio</p>
        </div>

        <!-- Balance -->
        <div class="group bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900 dark:to-blue-900 rounded-xl shadow-md hover:shadow-lg p-6 transition duration-300 border border-indigo-200 dark:border-indigo-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-700 dark:text-indigo-300 text-sm font-semibold uppercase tracking-wide">Balance Neto</p>
                    <p class="text-3xl font-bold {{ $balance >= 0 ? 'text-indigo-600 dark:text-indigo-400' : 'text-red-600 dark:text-red-400' }} mt-2">
                        €{{ number_format($balance, 2, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-full group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-bar {{ $balance >= 0 ? 'text-indigo-600 dark:text-indigo-300' : 'text-red-600 dark:text-red-300' }} text-2xl"></i>
                </div>
            </div>
            <p class="text-xs text-indigo-700 dark:text-indigo-300 mt-4">{{ $balance >= 0 ? '✓ Ganancia neta' : '✗ Pérdida neta' }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Income Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Ingresos Mensuales</h3>
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg p-4">
                <canvas id="incomeChart" class="max-h-80"></canvas>
            </div>
        </div>

        <!-- Properties Status Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Estado de Propiedades</h3>
            <div class="flex items-center justify-center">
                <canvas id="statusChart" class="max-h-80" style="max-width: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Transactions and Reservations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Transacciones Recientes</h3>
                <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver todas →</a>
            </div>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse($recentTransactions as $transaction)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                        <div class="flex items-center space-x-4 flex-1 min-w-0">
                            <div class="w-11 h-11 rounded-full {{ $transaction->isIncome() ? 'bg-green-100 dark:bg-green-900' : 'bg-red-100 dark:bg-red-900' }} flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $transaction->isIncome() ? 'fa-plus text-green-600 dark:text-green-400' : 'fa-minus text-red-600 dark:text-red-400' }}"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-gray-800 dark:text-white truncate">{{ $transaction->concept }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $transaction->property->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-right ml-2 flex-shrink-0">
                            <p class="font-bold {{ $transaction->isIncome() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $transaction->isIncome() ? '+' : '-' }}€{{ number_format($transaction->amount, 2, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>
                        <p class="text-gray-500 dark:text-gray-400">Sin transacciones recientes</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Reservations -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Próximas Reservas</h3>
                <a href="{{ route('reservations.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver todas →</a>
            </div>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse($upcomingReservations as $reservation)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                        <div class="flex items-center space-x-4 flex-1 min-w-0">
                            <div class="w-11 h-11 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-alt text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-gray-800 dark:text-white truncate">{{ $reservation->tenant->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $reservation->property->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-right ml-2 flex-shrink-0">
                            <p class="font-bold text-indigo-600 dark:text-indigo-400">€{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->start_date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-calendar text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>
                        <p class="text-gray-500 dark:text-gray-400">Sin reservas próximas</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Income Chart with better styling
    const incomeCtx = document.getElementById('incomeChart').getContext('2d');
    new Chart(incomeCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyIncome['labels']),
            datasets: [{
                label: 'Ingresos (€)',
                data: @json($monthlyIncome['data']),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { 
                    display: true,
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: { size: 12, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' },
                    ticks: { font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    // Status Chart with better styling
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Disponibles', 'Ocupadas'],
            datasets: [{
                data: [{{ $availableProperties }}, {{ $occupiedProperties }}],
                backgroundColor: ['#10b981', '#f97316'],
                borderColor: ['#059669', '#ea580c'],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: { size: 12, weight: 'bold' }
                    }
                }
            }
        }
    });
</script>
@endsection
