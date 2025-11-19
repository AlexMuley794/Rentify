@extends('layouts.app')

@section('title', 'Propiedades - Rentify')
@section('page-title', 'Gestión de Propiedades')

@section('content')
<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalProperties }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                    <i class="fas fa-home text-blue-600 dark:text-blue-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Disponibles</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $availableProperties }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Ocupadas</p>
                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 mt-2">{{ $occupiedProperties }}</p>
                </div>
                <div class="bg-orange-100 dark:bg-orange-900 p-3 rounded-lg">
                    <i class="fas fa-door-open text-orange-600 dark:text-orange-300 text-2xl"></i>
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Título</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Dirección</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Tipo</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Precio</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Estado</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($properties as $property)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $property->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $property->address }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($property->type)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $property->type->value == 'house' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($property->type->value == 'apartment' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200') }}">
                                        <i class="fas {{ $property->type->value == 'house' ? 'fa-house' : ($property->type->value == 'apartment' ? 'fa-building' : 'fa-store') }} mr-1"></i>
                                        {{ $property->type->label() }}
                                    </span>
                                @else
                                    <span class="text-gray-500">No definido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">€{{ number_format($property->price, 2, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center w-fit {{ $property->status == 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    <i class="fas {{ $property->status == 'available' ? 'fa-check-circle' : 'fa-lock' }} mr-1"></i>
                                    {{ $property->status == 'available' ? 'Disponible' : 'Ocupada' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('properties.show', $property) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition" title="Ver" data-tooltip="Ver detalles">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('properties.edit', $property) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition" title="Editar" data-tooltip="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition" title="Eliminar" data-tooltip="Eliminar">
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
                                    <i class="fas fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">No hay propiedades registradas</p>
                                    <a href="{{ route('properties.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        <i class="fas fa-plus mr-2"></i> Crear la primera
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-4">
                <p>Mostrando <span class="font-semibold">{{ $properties->count() }}</span> de <span class="font-semibold">{{ $properties->total() }}</span> propiedades</p>
            </div>
            {{ $properties->links() }}
        </div>
    </div>
</div>
@endsection
