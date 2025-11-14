@extends('layouts.app')

@section('title', $tenant->name . ' - Rentify')
@section('page-title', $tenant->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header with Actions -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-user-tie text-indigo-600 mr-3"></i>{{ $tenant->name }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 flex items-center">
                <i class="fas fa-envelope text-indigo-600 mr-2"></i>{{ $tenant->email }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <a href="{{ route('tenants.edit', $tenant) }}" class="bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <a href="{{ route('tenants.index') }}" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Main Info Section (2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-address-book text-indigo-600 mr-2"></i>Información de Contacto
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Email</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-2">
                            <i class="fas fa-envelope text-blue-600 mr-2"></i>{{ $tenant->email }}
                        </p>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Teléfono</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-2">
                            @if($tenant->phone)
                                <i class="fas fa-phone text-green-600 mr-2"></i>{{ $tenant->phone }}
                            @else
                                <span class="text-gray-500 italic">No registrado</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($tenant->notes)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-sticky-note text-indigo-600 mr-2"></i>Notas
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $tenant->notes }}</p>
                </div>
            @endif

            <!-- Properties Section -->
            @if($tenant->properties->count() > 0)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-home text-indigo-600 mr-2"></i>Propiedades Ocupadas ({{ $tenant->properties->count() }})
                    </h3>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($tenant->properties as $property)
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white flex items-center">
                                            <i class="fas fa-building text-indigo-600 mr-2"></i>{{ $property->title }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $property->address }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $property->status == 'available' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300' }}">
                                        {{ $property->status == 'available' ? '✓ Disponible' : '⊗ Ocupada' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Reservations Section -->
            @if($tenant->reservations->count() > 0)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>Reservas ({{ $tenant->reservations->count() }})
                    </h3>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($tenant->reservations as $reservation)
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $reservation->property->title }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            <i class="fas fa-calendar-alt mr-1"></i>{{ $reservation->start_date->format('d/m/Y') }} → {{ $reservation->end_date->format('d/m/Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $reservation->start_date->diffInDays($reservation->end_date) }} noches</p>
                                    </div>
                                    <p class="font-bold text-indigo-600 dark:text-indigo-400 text-right">€{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Information Card -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i>Información
                </h3>
                <div class="space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Registrado</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-1">{{ $tenant->created_at->format('d/m/Y') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hace {{ $tenant->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Última actualización</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-1">{{ $tenant->updated_at->format('d/m/Y H:i') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hace {{ $tenant->updated_at->diffForHumans() }}</p>
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
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Propiedades</p>
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full font-bold text-sm">{{ $tenant->properties->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-900/50 rounded-lg">
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Reservas</p>
                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full font-bold text-sm">{{ $tenant->reservations->count() }}</span>
                    </div>
                    @php
                        $totalInvested = $tenant->reservations->sum('total_price');
                    @endphp
                    <div class="p-3 bg-white dark:bg-gray-900/50 rounded-lg border-t border-indigo-200 dark:border-indigo-700 pt-4 mt-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Inversión Total</p>
                        <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">€{{ number_format($totalInvested, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
