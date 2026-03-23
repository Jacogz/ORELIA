<?php
/*
 * Author: Isabella Hernandez Posada
 * File: MaterialController.php
 * Description: Material controller with CRUD operations
 * Created: 2025-03-22
 */

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
    /**
     * Display home page with action buttons
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Home';

            return view('material.index')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::error('Material home page failed', ['error' => $e->getMessage()]);

            return view('material.index')->with('viewData', [
                'title' => 'Home',
            ]);
        }
    }

    /**
     * Display form to create a new material
     *
     * @return View
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Material';

        return view('material.create')->with('viewData', $viewData);
    }

    /**
     * Store a new material in the database
     * Validates input and creates material
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'color' => 'required|string|max:255',
        ]);

        try {
            $material = Material::create($validation_data);

            Log::info('Material created', ['material_id' => $material->id]);

            return redirect()->route('material.list')
                           ->with('success', 'Material created successfully');
        } catch (\Exception $e) {
            Log::error('Material creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('material.create')
                           ->withErrors(['error' => 'Could not create material.']);
        }
    }

    /**
     * Display list of all materials
     *
     * @return View
     */
    public function list(): View
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Materials List';
            $viewData['materials'] = Material::all();

            return view('material.list')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::error('Material list retrieval failed', ['error' => $e->getMessage()]);

            return view('material.list')->with('viewData', [
                'title' => 'Materials List',
                'materials' => [],
            ]);
        }
    }

    /**
     * Display details of a specific material
     *
     * @param string $id
     * @return View|RedirectResponse
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Material Details';
            $viewData['material'] = Material::findOrFail($id);

            return view('material.show')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::warning('Material not found', ['id' => $id]);

            return redirect()->route('material.list')
                           ->withErrors(['error' => 'Material not found.']);
        }
    }

    /**
     * Delete a material from database
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Material::findOrFail($id)->delete();

            Log::info('Material deleted', ['material_id' => $id]);

            return redirect()->route('material.list')
                           ->with('success', 'Material deleted successfully');
        } catch (\Exception $e) {
            Log::error('Material deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('material.list')
                           ->withErrors(['error' => 'Could not delete material.']);
        }
    }
}