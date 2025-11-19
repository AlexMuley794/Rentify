@extends('layouts.app')

@section('title', 'Editar Propiedad - Rentify')
@section('page-title', 'Editar Propiedad')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-edit text-indigo-600 mr-3"></i>Editar Propiedad
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Actualiza los detalles de tu propiedad</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
        <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            @method('PUT')

            <!-- Section: Información Básica -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-indigo-600 mr-3"></i>Información Básica
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Título *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $property->title) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Ej: Apartamento céntrico">
                        @error('title')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Dirección *</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $property->address) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Ej: Calle Principal 123, 5º B">
                        @error('address')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Detalles de la Propiedad -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-sliders-h text-indigo-600 mr-3"></i>Detalles de la Propiedad
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo de Propiedad *</label>
                        <select id="type" name="type" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                            <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>🏠 Casa</option>
                            <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>🏢 Apartamento</option>
                            <option value="local" {{ old('type', $property->type) == 'local' ? 'selected' : '' }}>🏬 Local</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Precio Mensual (€) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $property->price) }}" step="0.01" min="0" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="850.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status removed as it is derived from reservations -->
                </div>
            </div>

            <!-- Section: Inquilino Asignado -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-user-tie text-indigo-600 mr-3"></i>Inquilino Asignado
                </h2>
                <div>
                    <label for="tenant_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Selecciona un Inquilino (Opcional)</label>
                    <select id="tenant_id" name="tenant_id" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                        <option value="">Sin inquilino asignado</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id', $property->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->name }} ({{ $tenant->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('tenant_id')
                        <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section: Descripción e Imagen -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-3"></i>Detalles Adicionales
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                        <textarea id="description" name="description" rows="5" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition" placeholder="Describe las características principales de la propiedad...">{{ old('description', $property->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label for="image_path" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Imagen Principal</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image_path" class="w-full flex flex-col items-center justify-center px-6 py-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Haz clic para seleccionar una imagen</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF hasta 2MB</span>
                                <input type="file" id="image_path" name="image_path" accept="image/*" class="hidden">
                            </label>
                        </div>
                        @error('image_path')
                            <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                        @enderror
                        @if($property->image_path)
                            <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                                <p class="text-sm text-blue-700 dark:text-blue-300"><i class="fas fa-check-circle mr-2"></i>Imagen actual: <strong>{{ basename($property->image_path) }}</strong></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col sm:flex-row items-center gap-4">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Actualizar Propiedad
                </button>
                <a href="{{ route('properties.index') }}" class="w-full sm:w-auto bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
