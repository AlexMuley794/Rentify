@extends('layouts.app')

@section('title', 'Reservas - Rentify')
@section('page-title', 'Gestión de Reservas')

@section('content')
<div class="space-y-8">
    <!-- Header with Button -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Reservas</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Gestiona todas tus reservas</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-200">
            <i class="fas fa-calendar-plus mr-2"></i> Nueva Reserva
        </a>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Reservas</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $reservations->total() }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                    <i class="fas fa-calendar text-blue-600 dark:text-blue-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Activas</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $reservations->where('status', 'active')->count() }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Ingresos Esperados</p>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-2">€{{ number_format($reservations->sum('total_price'), 2, ',', '.') }}</p>
                </div>
                <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-lg">
                    <i class="fas fa-money-bill-wave text-indigo-600 dark:text-indigo-300 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Propiedad</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Inquilino</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Período</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Precio Total</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Estado</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $reservation->property->title }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->property->address }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $reservation->tenant->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->tenant->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $reservation->start_date->format('d/m') }} - {{ $reservation->end_date->format('d/m/Y') }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->start_date->diffInDays($reservation->end_date) }} noches</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-lg text-indigo-600 dark:text-indigo-400">€{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $reservation->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($reservation->status === 'completed' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('reservations.show', $reservation) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition" title="Ver">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('reservations.edit', $reservation) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition" title="Eliminar">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-calendar text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">No hay reservas registradas</p>
                                    <a href="{{ route('reservations.create') }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
                                        <i class="fas fa-calendar-plus mr-2"></i> Crear reserva
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection
