<?php
/*
 * Author: Isabella Hernandez Posada
 * File: MaterialController.php
 * Description: Handles CRUD operations for Materials
 */

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
    /**
     * Display all materials
     */
    public function index(): View
    {
        $view_data = [
            'title'     => 'Materials List',
            'materials' => Material::all(),
        ];

        return view('material.index', ['view_data' => $view_data]);
    }

    /**
     * Show the create material form
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create Material'];

        return view('material.create', ['view_data' => $view_data]);
    }

    /**
     * Store a new material
     */
    public function store(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string|max:50',
        ]);

        try {
            Material::create($validated_data);

            Log::info('Material created', ['name' => $validated_data['name']]);

            return redirect()->route('materials.index')
                ->with('success', 'Material created successfully!');

        } catch (\Exception $e) {
            Log::error('Material creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('materials.create')
                ->withErrors(['error' => 'Material could not be created.']);
        }
    }

    /**
     * Show a specific material
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title'    => 'Material Details',
                'material' => Material::findOrFail($id),
            ];

            return view('material.show', ['view_data' => $view_data]);

        } catch (\Exception $e) {
            Log::warning('Material not found', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        }
    }

    /**
     * Show the edit material form
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title'    => 'Edit Material',
                'material' => Material::findOrFail($id),
            ];

            return view('material.edit', ['view_data' => $view_data]);

        } catch (\Exception $e) {
            Log::warning('Material not found for edit', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        }
    }

    /**
     * Update an existing material
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated_data = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string|max:50',
        ]);

        try {
            $material = Material::findOrFail($id);
            $material->set_name($validated_data['name']);
            $material->set_type($validated_data['type']);
            $material->set_description($validated_data['description']);
            $material->set_color($validated_data['color']);
            $material->save();

            Log::info('Material updated', ['id' => $id]);

            return redirect()->route('materials.show', $id)
                ->with('success', 'Material updated successfully!');

        } catch (\Exception $e) {
            Log::error('Material update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.edit', $id)
                ->withErrors(['error' => 'Material could not be updated.']);
        }
    }

    /**
     * Delete a material
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Material::findOrFail($id)->delete();

            Log::info('Material deleted', ['id' => $id]);

            return redirect()->route('materials.index')
                ->with('success', 'Material deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Material deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material could not be deleted.']);
        }
    }
}