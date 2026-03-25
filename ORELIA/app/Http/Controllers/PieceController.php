<?php
/*
 * File: PieceController.php
 * Description: Handles HTTP request/response cycle for Piece resources.
 *              All model interaction is delegated to PieceService.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PieceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PieceController extends Controller
{
    private PieceService $piece_service;

    public function __construct()
    {
        $this->piece_service = new PieceService();
    }

    // -------------------------------------------------------------------------
    // Public read routes
    // -------------------------------------------------------------------------

    /**
     * Display all pieces (catalogue view).
     */
    public function index(): View
    {
        $view_data = [
            'title'  => 'Pieces Catalog',
            'pieces' => $this->piece_service->get_all_pieces(),
        ];

        return view('pieces.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single piece with all related data.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $piece = $this->piece_service->get_piece_by_id((int) $id);

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

    // -------------------------------------------------------------------------
    // Admin write routes
    // -------------------------------------------------------------------------

    /**
     * Show the create piece form.
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create New Piece'];

        return view('pieces.create', ['view_data' => $view_data]);
    }

    /**
     * Validate and persist a new piece.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'price'         => ['required', 'integer', 'min:0'],
            'type'          => ['required', 'string', 'max:255'],
            'image_url'     => ['nullable', 'string', 'max:255'],
            'size'          => ['required', 'string', 'max:255'],
            'stock'         => ['required', 'integer', 'min:0'],
            'weight'        => ['required', 'integer', 'min:0'],
            'collection_id' => ['required', 'integer', 'exists:collections,id'],
        ]);

        try {
            $piece = $this->piece_service->create_piece($validation_data);

            Log::info('Piece created', ['piece_id' => $piece->get_id(), 'name' => $piece->get_name()]);

            return redirect()->route('pieces.show', ['id' => $piece->get_id()])
                ->with('success', 'Piece created successfully.');

        } catch (\Exception $e) {
            Log::error('Piece creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('pieces.create')
                ->withErrors(['error' => 'Piece could not be created.']);
        }
    }

    /**
     * Show the edit piece form.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $piece = $this->piece_service->get_piece_for_edit((int) $id);

            $view_data = [
                'title' => 'Edit Piece',
                'piece' => $piece,
            ];

            return view('pieces.edit', ['view_data' => $view_data]);
            
        } catch (\Exception $e) {
            Log::warning('Piece not found for editing', ['id' => $id]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => 'Piece not found.']);
        }
    }

    /**
     * Validate and apply updates to an existing piece.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'price'         => ['required', 'integer', 'min:0'],
            'type'          => ['required', 'string', 'max:255'],
            'image_url'     => ['nullable', 'string', 'max:255'],
            'size'          => ['required', 'string', 'max:255'],
            'stock'         => ['required', 'integer', 'min:0'],
            'weight'        => ['required', 'integer', 'min:0'],
            'collection_id' => ['required', 'integer', 'exists:collections,id'],
        ]);

        try {
            $piece = $this->piece_service->update_piece((int) $id, $validation_data);

            Log::info('Piece updated', ['piece_id' => $piece->get_id()]);

            return redirect()->route('pieces.show', ['id' => $id])
                ->with('success', 'Piece updated successfully.');
        } catch (\Exception $e) {
            Log::error('Piece update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('pieces.edit', ['id' => $id])
                ->withErrors(['error' => 'Piece could not be updated.']);
        }
    }

    /**
     * Delete a piece by ID.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->piece_service->delete_piece((int) $id);

            Log::info('Piece deleted', ['piece_id' => $id]);

            return redirect()->route('pieces.index')
                ->with('success', 'Piece deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Piece deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => 'Piece could not be deleted.']);
        }
    }
}
