<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: CollectionController.php
 * Description: Final-user read-only controller for collections
 * Created: 2026-03-24
 */

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CollectionController extends Controller
{
    /**
     * Display all collections (read-only)
     */
    public function index(): View
    {
        $view_data = [
            'title' => 'Collections Catalog',
            'collections' => Collection::all(),
        ];

        return view('collections.index', ['viewData' => $view_data]);
    }

    /**
     * Show a single collection (read-only)
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $collection = Collection::with('pieces')->findOrFail($id);

            $view_data = [
                'title' => 'Collection Details',
                'collection' => $collection,
            ];

            return view('collections.show', ['viewData' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Collection not found', ['id' => $id]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection not found.']);
        }
    }
}
