<?php
/*
 * Author: GitHub Copilot
 * File: PieceController.php
 * Description: Final-user read-only controller for pieces
 * Created: 2026-03-24
 */

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Piece;
use Illuminate\Http\RedirectResponse;
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

        return view('piece.index', ['viewData' => $view_data]);
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

            return view('piece.show', ['viewData' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Piece not found', ['id' => $id]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => 'Piece not found.']);
        }
    }
}
