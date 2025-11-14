<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Tenant;
use App\Models\Reservation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $totalProperties = Property::count();
        $availableProperties = Property::where('status', 'available')->count();
        $occupiedProperties = Property::where('status', 'occupied')->count();
        $totalTenants = Tenant::count();

        // Ingresos y gastos (usar 0 como valor por defecto si no hay datos)
        $income = Transaction::where('type', 'income')->sum('amount') ?? 0;
        $expenses = Transaction::where('type', 'expense')->sum('amount') ?? 0;
        $balance = $income - $expenses;

        // Ingresos mensuales (últimos 6 meses)
        $monthlyIncome = $this->getMonthlyIncome();

        // Transacciones recientes
        $recentTransactions = Transaction::with('property')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Propiedades recientes
        $recentProperties = Property::with('tenant')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Reservas próximas
        $upcomingReservations = Reservation::with('property', 'tenant')
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProperties',
            'availableProperties',
            'occupiedProperties',
            'totalTenants',
            'income',
            'expenses',
            'balance',
            'monthlyIncome',
            'recentTransactions',
            'recentProperties',
            'upcomingReservations'
        ));
    }

    private function getMonthlyIncome()
    {
        $months = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $amount = Transaction::where('type', 'income')
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');
            
            $data[] = $amount;
        }

        return [
            'labels' => $months,
            'data' => $data,
        ];
    }
}
