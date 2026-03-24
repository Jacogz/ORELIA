<?php
/*
 * Author: Isabella Hernandez Posada
 * File: MaterialController.php
 * Description: Handles CRUD operations for Materials
 */

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

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
        $viewData = [
            'title' => 'Materials List',
            'materials' => Material::all(), // Fetch all materials
        ];

        return view('material.index', ['viewData' => $viewData]);
    }

    /**
     * Show the create material form
     */
    public function create(): View
    {
        $viewData = [
            'title' => 'Create Material',
        ];

    return view('material.create', ['viewData' => $viewData]);
    }

    /**
     * Store a new material
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string|max:50',
        ]);

        try {
            // Create new material
            Material::create($validated);

            Log::info('Material created', ['name' => $validated['name']]);

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
            $material = Material::findOrFail($id);

            $viewData = [
                'title' => 'Material Details',
                'material' => $material,
            ];

            return view('material.show', ['viewData' => $viewData]);
        } catch (\Exception $e) {
            Log::warning('Material not found', ['id' => $id]);

            return redirect()->route('materials.index')
                             ->withErrors(['error' => 'Material not found.']);
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