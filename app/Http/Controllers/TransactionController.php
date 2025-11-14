<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Property;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('property')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::all();
        return view('transactions.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
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
        $transaction->load('property');
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $properties = Property::all();
        return view('transactions.edit', compact('transaction', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
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
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada exitosamente');
    }
}
