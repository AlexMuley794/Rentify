@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-indigo-900 flex flex-col justify-center items-center px-6 py-20">
    <div class="w-full max-w-2xl">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="mb-6">
                <i class="fas fa-building text-6xl text-indigo-600 dark:text-indigo-400"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                Gestiona tus Alquileres Inteligentemente
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                Rentify es la solución completa para administrar propiedades, inquilinos, reservas y finanzas de tu negocio de alquileres en un solo lugar.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-chart-line mr-2"></i>
                    Ir al Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-rocket mr-2"></i>
                    Comenzar Ahora
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Ya tengo cuenta
                </a>
            @endauth
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-home text-2xl text-indigo-600 dark:text-indigo-400 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Gestión de Propiedades</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300">Administra todas tus propiedades en un solo lugar con información detallada y actualizada.</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-users text-2xl text-green-600 dark:text-green-400 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Control de Inquilinos</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300">Mantén un registro completo de tus inquilinos y su información de contacto.</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-calendar-check text-2xl text-purple-600 dark:text-purple-400 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Reservas Eficientes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300">Gestiona las reservas y fechas de ocupación de manera sencilla.</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-line text-2xl text-blue-600 dark:text-blue-400 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Análisis Financiero</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300">Monitorea ingresos, gastos y métricas con gráficos en tiempo real.</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-3 gap-6 text-center">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">1000+</div>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Usuarios Activos</p>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="text-3xl font-bold text-green-600 dark:text-green-400">5K+</div>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Propiedades</p>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">$M+</div>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Gestionados</p>
            </div>
        </div>
    </div>
</div>
@endsection
