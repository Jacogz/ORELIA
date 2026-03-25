<?php
/* 
 * Author: Jacobo Giraldo Zuluaga-Jeremias Figueroa Garcia 
 * File: CollectionController.php
 * Description: Handles HTTP request/response cycle for Collection resources.
 *              All model interaction is delegated to CollectionService.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CollectionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CollectionController extends Controller
{
    private CollectionService $collection_service;

    public function __construct()
    {
        $this->collection_service = new CollectionService();
    }

    // -------------------------------------------------------------------------
    // Public read routes
    // -------------------------------------------------------------------------

    /**
     * Display all collections.
     */
    public function index(): View
    {
        $view_data = [
            'title'       => 'Collections Catalog',
            'collections' => $this->collection_service->get_all_collections(),
        ];

        return view('collections.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single collection with its pieces.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $collection = $this->collection_service->get_collection_by_id((int) $id);

            $view_data = [
                'title'      => 'Collection Details',
                'collection' => $collection,
            ];

            return view('collections.show', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Collection not found', ['id' => $id]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection not found.']);
        } catch (\Exception $e) {
            Log::error('Failed to load collection', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Could not load collection.']);
        }
    }

    // -------------------------------------------------------------------------
    // Admin write routes
    // -------------------------------------------------------------------------

    /**
     * Show the create collection form.
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create Collection'];

        return view('collections.create', ['view_data' => $view_data]);
    }

    /**
     * Validate and persist a new collection.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'creation_date' => ['required', 'date'],
        ]);

        try {
            $collection = $this->collection_service->create_collection($validation_data);

            Log::info('Collection created', [
                'collection_id' => $collection->get_id(),
                'name'          => $collection->get_name(),
            ]);

            return redirect()->route('collections.show', ['id' => $collection->get_id()])
                ->with('success', 'Collection created successfully.');
        } catch (\Exception $e) {
            Log::error('Collection creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('collections.create')
                ->withErrors(['error' => 'Collection could not be created.']);
        }
    }

    /**
     * Show the edit collection form.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $collection = $this->collection_service->get_collection_for_edit((int) $id);

            $view_data = [
                'title'      => 'Edit Collection',
                'collection' => $collection,
            ];

            return view('collections.edit', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Collection not found for editing', ['id' => $id]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection not found.']);
        } catch (\Exception $e) {
            Log::error('Failed to load collection for editing', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Could not load collection.']);
        }
    }

    /**
     * Validate and apply updates to an existing collection.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'creation_date' => ['required', 'date'],
        ]);

        try {
            $collection = $this->collection_service->update_collection((int) $id, $validation_data);

            Log::info('Collection updated', ['collection_id' => $collection->get_id()]);

            return redirect()->route('collections.show', ['id' => $id])
                ->with('success', 'Collection updated successfully.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Collection not found for update', ['id' => $id]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection not found.']);
        } catch (\Exception $e) {
            Log::error('Collection update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('collections.edit', ['id' => $id])
                ->withErrors(['error' => 'Collection could not be updated.']);
        }
    }

    /**
     * Delete a collection by ID.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->collection_service->delete_collection((int) $id);

            Log::info('Collection deleted', ['collection_id' => $id]);

            return redirect()->route('collections.index')
                ->with('success', 'Collection deleted successfully.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Collection not found for deletion', ['id' => $id]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection not found.']);
        } catch (\Exception $e) {
            Log::error('Collection deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('collections.index')
                ->withErrors(['error' => 'Collection could not be deleted.']);
        }
    }
}
