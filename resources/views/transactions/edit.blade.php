@extends('layouts.app')

@section('title', 'Editar Transacción - Rentify')
@section('page-title', 'Editar Transacción')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-edit text-indigo-600 mr-3"></i>Editar Transacción
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Actualiza el registro de la transacción</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-6 p-8">
            @csrf
            @method('PUT')

            <!-- Section: Propiedad -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-home text-indigo-600 mr-3"></i>Propiedad
                </h2>
                <div>
                    <label for="property_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Propiedad *</label>
                    <select id="property_id" name="property_id" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" {{ old('property_id', $transaction->property_id) == $property->id ? 'selected' : '' }}>
                                🏠 {{ $property->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('property_id')
                        <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section: Tipo y Monto -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-coins text-indigo-600 mr-3"></i>Tipo y Monto
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo de Transacción *</label>
                        <select id="type" name="type" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                            <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>💰 Ingreso</option>
                            <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>💸 Gasto</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Monto (€) *</label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" step="0.01" min="0" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="0.00">
                        @error('amount')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Detalles -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-3"></i>Detalles de la Transacción
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Concept -->
                    <div>
                        <label for="concept" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Concepto *</label>
                        <input type="text" id="concept" name="concept" value="{{ old('concept', $transaction->concept) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Ej: Alquiler mes de octubre">
                        @error('concept')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Fecha *</label>
                        <input type="date" id="date" name="date" value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                        @error('date')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col sm:flex-row items-center gap-4">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Actualizar Transacción
                </button>
                <a href="{{ route('transactions.index') }}" class="w-full sm:w-auto bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
