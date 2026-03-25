<?php
/*
 * Author: Isabella Hernandez Posada-Jacobo Giraldo Zuluaga
 * File: MaterialController.php
 * Description: Handles HTTP request/response cycle for Material resources.
 *              All model interaction is delegated to MaterialService.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MaterialService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MaterialController extends Controller
{
    private MaterialService $material_service;

    public function __construct()
    {
        $this->material_service = new MaterialService();
    }

    // -------------------------------------------------------------------------
    // Public read routes
    // -------------------------------------------------------------------------

    /**
     * Display all materials.
     */
    public function index(): View
    {
        $view_data = [
            'title'     => 'Materials List',
            'materials' => $this->material_service->get_all_materials(),
        ];

        return view('materials.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single material with its associated pieces.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $material = $this->material_service->get_material_by_id((int) $id);

            $view_data = [
                'title'    => 'Material Details',
                'material' => $material,
            ];

            return view('materials.show', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Material not found', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        } catch (\Exception $e) {
            Log::error('Failed to load material', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Could not load material.']);
        }
    }

    // -------------------------------------------------------------------------
    // Admin write routes
    // -------------------------------------------------------------------------

    /**
     * Show the create material form.
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create Material'];

        return view('materials.create', ['view_data' => $view_data]);
    }

    /**
     * Validate and persist a new material.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'type'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'color'       => ['required', 'string', 'max:50'],
        ]);

        try {
            $material = $this->material_service->create_material($validation_data);

            Log::info('Material created', [
                'material_id' => $material->get_id(),
                'name'        => $material->get_name(),
            ]);

            return redirect()->route('materials.show', ['id' => $material->get_id()])
                ->with('success', 'Material created successfully.');
        } catch (\Exception $e) {
            Log::error('Material creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('materials.create')
                ->withErrors(['error' => 'Material could not be created.']);
        }
    }

    /**
     * Show the edit material form.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $material = $this->material_service->get_material_for_edit((int) $id);

            $view_data = [
                'title'    => 'Edit Material',
                'material' => $material,
            ];

            return view('materials.edit', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Material not found for editing', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        } catch (\Exception $e) {
            Log::error('Failed to load material for editing', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Could not load material.']);
        }
    }

    /**
     * Validate and apply updates to an existing material.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'type'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'color'       => ['required', 'string', 'max:50'],
        ]);

        try {
            $material = $this->material_service->update_material((int) $id, $validation_data);

            Log::info('Material updated', ['material_id' => $material->get_id()]);

            return redirect()->route('materials.show', ['id' => $id])
                ->with('success', 'Material updated successfully.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Material not found for update', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        } catch (\Exception $e) {
            Log::error('Material update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.edit', ['id' => $id])
                ->withErrors(['error' => 'Material could not be updated.']);
        }
    }

    /**
     * Delete a material by ID.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->material_service->delete_material((int) $id);

            Log::info('Material deleted', ['material_id' => $id]);

            return redirect()->route('materials.index')
                ->with('success', 'Material deleted successfully.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Material not found for deletion', ['id' => $id]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material not found.']);
        } catch (\Exception $e) {
            Log::error('Material deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('materials.index')
                ->withErrors(['error' => 'Material could not be deleted.']);
        }
    }
}
