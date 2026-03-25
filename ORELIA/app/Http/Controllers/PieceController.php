<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: PieceController.php
 * Description: Final-user read-only controller for pieces
 * Created: 2026-03-24
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Piece;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PieceController extends Controller
{
    /**
     * Display all pieces (read-only)
     */
    public function index(): View
    {
        $view_data = [
            'title' => 'Pieces Catalog',
            'pieces' => Piece::with('collection')->get(),
        ];

        return view('pieces.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single piece (read-only)
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $piece = Piece::with(['collection', 'materials', 'order_items'])->findOrFail($id);

            $view_data = [
                'title' => 'Piece Details',
                'piece' => $piece,
            ];

            return view('pieces.show', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Piece not found', ['id' => $id]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => 'Piece not found.']);
        }
    }

    public function create(): View
    {
        $view_data = ['title' => 'Create New Piece'];

        return view('pieces.create')->with('view_data', $view_data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'size' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
        ]);

        if (empty($validation_data['image_url'])) {
            $validation_data['image_url'] = url('/images/default.svg');
        }
        
        try {
            $piece = Piece::create($validation_data);

            Log::info('Piece created', ['name' => $validation_data['name']]);
            
            return redirect()->route('pieces.show', ['id' => $piece->get_id()])
                ->with('success', 'Piece created successfully.');
        } catch (\Exception $e) {
            Log::error('Piece creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('pieces.create')
                ->withErrors(['error' => 'Piece could not be created.']);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $piece = Piece::findOrFail($id);

            $view_data = [
                'title' => 'Edit Piece',
                'piece' => $piece,
            ];

            return view('pieces.edit')->with('view_data', $view_data);

        } catch (\Exception $e) {
            Log::warning('Piece not found for editing', ['id' => $id]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => 'Piece not found.']);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'size' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
        ]);

        try {
            $piece = Piece::findOrFail($id);
            $piece->update($validation_data);

            Log::info('Piece updated', ['id' => $id]);

            return redirect()->route('pieces.show', ['id' => $id])
                ->with('success', 'Piece updated successfully.');

        } catch (\Exception $e) {
            Log::error('Piece update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('pieces.edit', ['id' => $id])
                ->withErrors(['error' => 'Piece could not be updated.']);
        }
    }

    public function delete($id): RedirectResponse
    {
        $piece = Piece::findOrFail($id);
        $piece->delete();
        return redirect()->route('pieces.index')->with('success', 'Piece deleted successfully.');
    }
}
