@extends('layouts.app')

@section('title', 'Transacciones - Rentify')
@section('page-title', 'Gestión de Transacciones')

@section('content')
<div class="space-y-8">
    <!-- Header with Button -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Transacciones</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Historial de ingresos y gastos</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-200">
            <i class="fas fa-plus mr-2"></i> Nueva Transacción
        </a>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Ingresos</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">€{{ number_format($totalIncome, 2, ',', '.') }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                    <i class="fas fa-arrow-up text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Gastos</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">€{{ number_format($totalExpenses, 2, ',', '.') }}</p>
                </div>
                <div class="bg-red-100 dark:bg-red-900 p-3 rounded-lg">
                    <i class="fas fa-arrow-down text-red-600 dark:text-red-300 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Balance Neto</p>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-2">€{{ number_format($netBalance, 2, ',', '.') }}</p>
                </div>
                <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-lg">
                    <i class="fas fa-balance-scale text-indigo-600 dark:text-indigo-300 text-2xl"></i>
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Concepto</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Tipo</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Monto</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Fecha</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->property->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $transaction->concept }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    <i class="fas {{ $transaction->type == 'income' ? 'fa-plus' : 'fa-minus' }} mr-1"></i>
                                    {{ $transaction->type == 'income' ? 'Ingreso' : 'Gasto' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-lg {{ $transaction->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }}€{{ number_format($transaction->amount, 2, ',', '.') }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $transaction->date->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition" title="Ver">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
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
                                    <i class="fas fa-exchange-alt text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">No hay transacciones registradas</p>
                                    <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                        <i class="fas fa-plus mr-2"></i> Añadir transacción
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
