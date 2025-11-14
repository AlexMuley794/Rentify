@extends('layouts.app')

@section('title', $property->title . ' - Rentify')
@section('page-title', $property->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header with Actions -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-building text-indigo-600 mr-3"></i>{{ $property->title }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 flex items-center">
                <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>{{ $property->address }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <a href="{{ route('properties.edit', $property) }}" class="bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <a href="{{ route('properties.index') }}" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Main Info Section (2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Property Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Tipo de Propiedad</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1 capitalize">{{ $property->type }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-home text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Precio Mensual</p>
                            <p class="text-2xl font-bold text-indigo-600 mt-1">€{{ number_format($property->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-euro-sign text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Estado</p>
                            <p class="text-lg font-bold mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $property->status == 'available' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300' }}">
                                    <i class="fas {{ $property->status == 'available' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                    {{ $property->status == 'available' ? 'Disponible' : 'Ocupada' }}
                                </span>
                            </p>
                        </div>
                        <div class="w-12 h-12 {{ $property->status == 'available' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }} rounded-xl flex items-center justify-center">
                            <i class="fas {{ $property->status == 'available' ? 'fa-check-circle text-green-600' : 'fa-ban text-red-600' }} text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Inquilino</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                {{ $property->tenant ? $property->tenant->name : 'Sin asignar' }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-tie text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-2"></i>Descripción
                </h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $property->description ?? 'Sin descripción disponible.' }}</p>
            </div>

            <!-- Reservations Section -->
            @if($property->reservations->count() > 0)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-calendar text-indigo-600 mr-2"></i>Reservas ({{ $property->reservations->count() }})
                    </h3>
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($property->reservations as $reservation)
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $reservation->tenant->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            <i class="fas fa-calendar-alt mr-1"></i>{{ $reservation->start_date->format('d/m/Y') }} → {{ $reservation->end_date->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-indigo-600 dark:text-indigo-400">€{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $reservation->start_date->diffInDays($reservation->end_date) }} noches</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Transactions Section -->
            @if($property->transactions->count() > 0)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-exchange-alt text-indigo-600 mr-2"></i>Últimas Transacciones
                    </h3>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($property->transactions->take(10) as $transaction)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition">
                                <div class="flex items-center space-x-3 flex-1">
                                    <div class="w-10 h-10 rounded-full {{ $transaction->isIncome() ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }} flex items-center justify-center">
                                        <i class="fas {{ $transaction->isIncome() ? 'fa-arrow-down text-green-600' : 'fa-arrow-up text-red-600' }}"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->concept }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->date->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <p class="font-bold {{ $transaction->isIncome() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $transaction->isIncome() ? '+' : '-' }}€{{ number_format($transaction->amount, 2, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Timeline Card -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-clock text-indigo-600 mr-2"></i>Información de Fechas
                </h3>
                <div class="space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Creado el</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-1">{{ $property->created_at->format('d/m/Y') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hace {{ $property->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Última actualización</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-1">{{ $property->updated_at->format('d/m/Y H:i') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hace {{ $property->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 rounded-xl shadow-lg border border-indigo-200 dark:border-indigo-800 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-indigo-600 mr-2"></i>Estadísticas
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-900/50 rounded-lg">
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Reservas Totales</p>
                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full font-bold text-sm">{{ $property->reservations->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-900/50 rounded-lg">
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Transacciones</p>
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full font-bold text-sm">{{ $property->transactions->count() }}</span>
                    </div>
                    @php
                        $income = $property->transactions->where('type', 'income')->sum('amount');
                        $expenses = $property->transactions->where('type', 'expense')->sum('amount');
                    @endphp
                    <div class="p-3 bg-white dark:bg-gray-900/50 rounded-lg border-t border-indigo-200 dark:border-indigo-700 pt-4 mt-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Ingresos Totales</p>
                        <p class="text-xl font-bold text-green-600 dark:text-green-400 mt-1">€{{ number_format($income, 2, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-900/50 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Gastos Totales</p>
                        <p class="text-xl font-bold text-red-600 dark:text-red-400 mt-1">€{{ number_format($expenses, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
