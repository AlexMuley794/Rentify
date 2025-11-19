<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Property::query();

        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        // Clone query for stats to avoid modifying the main pagination query
        $statsQuery = clone $query;
        $totalProperties = $statsQuery->count();
        
        // For status, we need to check reservations. 
        // Since status is an accessor, we can't query it directly easily in SQL without replicating logic.
        // However, is_occupied is based on active reservations.
        // We can count properties that have active reservations.
        $occupiedProperties = (clone $query)->whereHas('reservations', function ($q) {
            $q->where('start_date', '<=', now())
              ->where('end_date', '>=', now());
        })->count();

        $availableProperties = $totalProperties - $occupiedProperties;

        $properties = $query->with('reservations.tenant')->latest()->paginate(10);

        return view('properties.index', compact('properties', 'totalProperties', 'availableProperties', 'occupiedProperties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('properties', 'public');
        }

        Property::create($validated);

        return redirect()->route('properties.index')->with('success', 'Propiedad creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $this->authorize('view', $property);
        $property->load('reservations', 'transactions');
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);
        
        $validated = $request->validated();

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('properties', 'public');
        }

        $property->update($validated);

        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada exitosamente');
    }
}
