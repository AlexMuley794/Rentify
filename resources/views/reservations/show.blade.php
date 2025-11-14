@extends('layouts.app')

@section('title', 'Reserva - Rentify')
@section('page-title', 'Detalles de Reserva')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Reserva #{{ $reservation->id }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $reservation->property->title }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('reservations.edit', $reservation) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg flex items-center space-x-2 transition">
                <i class="fas fa-edit"></i>
                <span>Editar</span>
            </a>
            <a href="{{ route('reservations.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 space-y-6">
                <!-- Reservation Details -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Detalles de la Reserva</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Propiedad</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->property->title }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Inquilino</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->tenant->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fecha Inicio</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->start_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fecha Fin</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->end_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Duración</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->start_date->diffInDays($reservation->end_date) }} días</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Precio Total</p>
                            <p class="text-gray-800 dark:text-white font-semibold">€{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Información de la Propiedad</h3>
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="font-semibold text-gray-800 dark:text-white mb-2">{{ $reservation->property->title }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $reservation->property->address }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Tipo: <span class="font-semibold">{{ ucfirst($reservation->property->type) }}</span></p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Precio/mes: <span class="font-semibold">€{{ number_format($reservation->property->price, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <!-- Tenant Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Información del Inquilino</h3>
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="font-semibold text-gray-800 dark:text-white mb-2">{{ $reservation->tenant->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $reservation->tenant->email }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $reservation->tenant->phone ?? 'Teléfono no registrado' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Información</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Creada</p>
                        <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Última actualización</p>
                        <p class="text-gray-800 dark:text-white font-semibold">{{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Accesos Rápidos</h3>
                <div class="space-y-3">
                    <a href="{{ route('properties.show', $reservation->property) }}" class="block px-4 py-2 bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-800 text-center font-semibold transition">
                        Ver Propiedad
                    </a>
                    <a href="{{ route('tenants.show', $reservation->tenant) }}" class="block px-4 py-2 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded-lg hover:bg-purple-200 dark:hover:bg-purple-800 text-center font-semibold transition">
                        Ver Inquilino
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
