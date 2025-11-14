@extends('layouts.app')

@section('title', 'Editar Inquilino - Rentify')
@section('page-title', 'Editar Inquilino')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-edit text-indigo-600 mr-3"></i>Editar Inquilino
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Actualiza los datos del inquilino</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
        <form action="{{ route('tenants.update', $tenant) }}" method="POST" class="space-y-6 p-8">
            @csrf
            @method('PUT')

            <!-- Section: Información Personal -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-user text-indigo-600 mr-3"></i>Información Personal
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nombre Completo *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $tenant->name) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Ej: Juan García López">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $tenant->email) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="juan.garcia@example.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Información de Contacto -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-phone text-indigo-600 mr-3"></i>Información de Contacto
                </h2>
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Teléfono (Opcional)</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $tenant->phone) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="+34 612 345 678">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section: Notas Adicionales -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-3"></i>Notas Adicionales
                </h2>
                <div>
                    <label for="notes" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Notas (Opcional)</label>
                    <textarea id="notes" name="notes" rows="5" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Añade notas sobre el inquilino...">{{ old('notes', $tenant->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col sm:flex-row items-center gap-4">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Actualizar Inquilino
                </button>
                <a href="{{ route('tenants.index') }}" class="w-full sm:w-auto bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
