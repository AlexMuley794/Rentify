<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with('tenant')->paginate(10);
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::all();
        return view('properties.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:house,apartment,local',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tenant_id' => 'nullable|exists:tenants,id',
        ]);

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
        $property->load('tenant', 'reservations', 'transactions');
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $tenants = Tenant::all();
        return view('properties.edit', compact('property', 'tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:house,apartment,local',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tenant_id' => 'nullable|exists:tenants,id',
        ]);

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
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada exitosamente');
    }
}
