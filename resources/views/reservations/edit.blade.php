@extends('layouts.app')

@section('title', 'Editar Reserva - Rentify')
@section('page-title', 'Editar Reserva')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-edit text-indigo-600 mr-3"></i>Editar Reserva
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Actualiza los detalles de la reserva</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
        <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="space-y-6 p-8">
            @csrf
            @method('PUT')

            <!-- Section: Propiedad e Inquilino -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-link text-indigo-600 mr-3"></i>Propiedad e Inquilino
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Property -->
                    <div>
                        <label for="property_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Propiedad *</label>
                        <select id="property_id" name="property_id" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" {{ old('property_id', $reservation->property_id) == $property->id ? 'selected' : '' }}>
                                    🏠 {{ $property->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tenant -->
                    <div>
                        <label for="tenant_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Inquilino *</label>
                        <select id="tenant_id" name="tenant_id" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ old('tenant_id', $reservation->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                    👤 {{ $tenant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tenant_id')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Fechas -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-calendar-alt text-indigo-600 mr-3"></i>Fechas de la Reserva
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Fecha de Inicio *</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $reservation->start_date->format('Y-m-d')) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Fecha de Fin *</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $reservation->end_date->format('Y-m-d')) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Precio -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-euro-sign text-indigo-600 mr-3"></i>Precio Total
                </h2>
                <div>
                    <label for="total_price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Precio Total (€) *</label>
                    <input type="number" id="total_price" name="total_price" value="{{ old('total_price', $reservation->total_price) }}" step="0.01" min="0" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="0.00">
                    @error('total_price')
                        <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col sm:flex-row items-center gap-4">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Actualizar Reserva
                </button>
                <a href="{{ route('reservations.index') }}" class="w-full sm:w-auto bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
    </div>
</div>
@endsection
