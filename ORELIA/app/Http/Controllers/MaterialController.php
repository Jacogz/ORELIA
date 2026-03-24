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
    'title' => 'Materials List',
    'materials' => Material::all(),
];
    return view('material.index', ['viewData' => $view_data]);
    }

    /**
     * Show the create material form
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create Material'];
return view('material.create', ['viewData' => $view_data]);
    }

    /**
     * Store a new material
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $validation_data = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'description' => 'required|string',
            'color'       => 'required|string|max:50',
        ]);

        try {
            // Create new material
            Material::create($validation_data);

            Log::info('Material created', ['name' => $validation_data['name']]);
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

            $view_data = ['title' => 'Material Details', 'material' => $material];
return view('material.show', ['viewData' => $view_data]);
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