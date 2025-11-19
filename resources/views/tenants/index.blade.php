@extends('layouts.app')

@section('title', 'Inquilinos - Rentify')
@section('page-title', 'Gestión de Inquilinos')

@section('content')
<div class="space-y-8">
    <!-- Header with Button -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Inquilinos</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Administra tus inquilinos activos</p>
        </div>
        <a href="{{ route('tenants.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-200">
            <i class="fas fa-user-plus mr-2"></i> Nuevo Inquilino
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Inquilinos</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $tenants->total() }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                    <i class="fas fa-users text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Con Propiedades</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $tenantsWithPropertiesCount }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                    <i class="fas fa-check-circle text-blue-600 dark:text-blue-300 text-2xl"></i>
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Nombre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Teléfono</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Propiedades</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($tenants as $tenant)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $tenant->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $tenant->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $tenant->phone ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <i class="fas fa-home mr-1"></i> {{ $tenant->properties_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('tenants.show', $tenant) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition" title="Ver">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('tenants.edit', $tenant) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
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
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-users text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">No hay inquilinos registrados</p>
                                    <a href="{{ route('tenants.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                        <i class="fas fa-user-plus mr-2"></i> Añadir inquilino
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
                <p>Mostrando <span class="font-semibold">{{ $tenants->count() }}</span> de <span class="font-semibold">{{ $tenants->total() }}</span> inquilinos</p>
            </div>
            {{ $tenants->links() }}
        </div>
    </div>
</div>
@endsection
