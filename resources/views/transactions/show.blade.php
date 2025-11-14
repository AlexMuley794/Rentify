@extends('layouts.app')

@section('title', 'Transacción - Rentify')
@section('page-title', 'Detalles de Transacción')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Transacción #{{ $transaction->id }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $transaction->property->title }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('transactions.edit', $transaction) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg flex items-center space-x-2 transition">
                <i class="fas fa-edit"></i>
                <span>Editar</span>
            </a>
            <a href="{{ route('transactions.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 space-y-6">
                <!-- Transaction Details -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Detalles</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Tipo</p>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $transaction->type == 'income' ? 'Ingreso' : 'Gasto' }}
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Monto</p>
                                <p class="text-2xl font-bold {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }}€{{ number_format($transaction->amount, 2, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Concepto</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $transaction->concept }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fecha</p>
                            <p class="text-gray-800 dark:text-white font-semibold">{{ $transaction->date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Propiedad Asociada</h3>
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="font-semibold text-gray-800 dark:text-white mb-2">{{ $transaction->property->title }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $transaction->property->address }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Precio/mes: <span class="font-semibold">€{{ number_format($transaction->property->price, 2, ',', '.') }}</span></p>
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
                        <p class="text-gray-800 dark:text-white font-semibold">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Última actualización</p>
                        <p class="text-gray-800 dark:text-white font-semibold">{{ $transaction->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Accesos Rápidos</h3>
                <a href="{{ route('properties.show', $transaction->property) }}" class="block px-4 py-2 bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-800 text-center font-semibold transition">
                    Ver Propiedad
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
