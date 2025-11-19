<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TenantController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $tenants = Tenant::withCount('properties')->paginate(10);
            $tenantsWithPropertiesCount = Tenant::has('properties')->count();
        } else {
            $tenants = Tenant::where('user_id', $user->id)->withCount('properties')->paginate(10);
            $tenantsWithPropertiesCount = Tenant::where('user_id', $user->id)->has('properties')->count();
        }
        
        return view('tenants.index', compact('tenants', 'tenantsWithPropertiesCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:tenants',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Tenant::create($validated);

        return redirect()->route('tenants.index')->with('success', 'Inquilino creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);
        $tenant->load('properties', 'reservations');
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $this->authorize('update', $tenant);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'notes' => 'nullable|string',
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.index')->with('success', 'Inquilino actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->authorize('delete', $tenant);
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Inquilino eliminado exitosamente');
    }
}
