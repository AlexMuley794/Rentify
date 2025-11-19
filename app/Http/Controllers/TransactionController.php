<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Property;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Transaction::query();

        if (!$user->isAdmin()) {
            $query->whereHas('property', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Stats
        $statsQuery = clone $query;
        $totalIncome = (clone $statsQuery)->where('type', 'income')->sum('amount');
        $totalExpenses = (clone $statsQuery)->where('type', 'expense')->sum('amount');
        $netBalance = $totalIncome - $totalExpenses;

        $transactions = $query->with('property')->latest()->paginate(10);

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpenses', 'netBalance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $properties = $user->isAdmin() ? Property::all() : Property::where('user_id', $user->id)->get();
        return view('transactions.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => [
                'required',
                Rule::exists('properties', 'id')->where(function ($query) {
                    if (!Auth::user()->isAdmin()) {
                        $query->where('user_id', Auth::id());
                    }
                }),
            ],
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'concept' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transacción registrada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        $transaction->load('property');
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        $user = Auth::user();
        $properties = $user->isAdmin() ? Property::all() : Property::where('user_id', $user->id)->get();
        return view('transactions.edit', compact('transaction', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        
        $validated = $request->validate([
            'property_id' => [
                'required',
                Rule::exists('properties', 'id')->where(function ($query) {
                    if (!Auth::user()->isAdmin()) {
                        $query->where('user_id', Auth::id());
                    }
                }),
            ],
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'concept' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transacción actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada exitosamente');
    }
}
