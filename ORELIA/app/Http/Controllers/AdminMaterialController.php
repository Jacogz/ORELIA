<?php
/*
 * Author: GitHub Copilot
 * File: AdminMaterialController.php
 * Description: Admin-only complete CRUD for Material
 * Created: 2026-03-24
 */

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminMaterialController extends Controller
{
    public function index(): View
    {
        $view_data = [
            'title' => 'Admin Materials',
            'materials' => Material::all(),
        ];

        return view('admin.material.index', ['view_data' => $view_data]);
    }

    public function create(): View
    {
        $view_data = [
            'title' => 'Admin Create Material',
        ];

        return view('admin.material.create', ['view_data' => $view_data]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string', 'max:50'],
        ]);

        try {
            Material::create($validation_data);

            Log::info('Admin created material', ['name' => $validation_data['name']]);

            return redirect()->route('admin.materials.index')->with('success', 'Material created successfully.');
        } catch (\Exception $e) {
            Log::error('Admin material creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('admin.materials.create')->withErrors(['error' => 'Material could not be created.']);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $material = Material::findOrFail($id);

            $view_data = [
                'title' => 'Admin Material Details',
                'material' => $material,
            ];

            return view('admin.material.show', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Admin material not found', ['id' => $id]);

            return redirect()->route('admin.materials.index')->withErrors(['error' => 'Material not found.']);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $material = Material::findOrFail($id);

            $view_data = [
                'title' => 'Admin Edit Material',
                'material' => $material,
            ];

            return view('admin.material.edit', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Admin material edit target not found', ['id' => $id]);

            return redirect()->route('admin.materials.index')->withErrors(['error' => 'Material not found.']);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string', 'max:50'],
        ]);

        try {
            $material = Material::findOrFail($id);
            $material->update($validation_data);

            Log::info('Admin updated material', ['id' => $id]);

            return redirect()->route('admin.materials.show', $id)->with('success', 'Material updated successfully.');
        } catch (\Exception $e) {
            Log::error('Admin material update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.materials.edit', $id)->withErrors(['error' => 'Material could not be updated.']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $material = Material::findOrFail($id);
            $material->delete();

            Log::info('Admin deleted material', ['id' => $id]);

            return redirect()->route('admin.materials.index')->with('success', 'Material deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Admin material deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.materials.index')->withErrors(['error' => 'Material could not be deleted.']);
        }
    }
}
