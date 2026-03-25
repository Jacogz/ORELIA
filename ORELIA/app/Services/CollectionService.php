<?php
/*
 * File: CollectionService.php
 * Description: Service layer for all Collection-related database operations.
 *              Controllers must not query the Collection model directly —
 *              all access goes through here.
 */

namespace App\Services;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CollectionService
{
    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all collections.
     *
     * @return EloquentCollection<int, Collection>
     */
    public function get_all_collections(): EloquentCollection
    {
        return Collection::all();
    }

    /**
     * Find a single collection by ID with its pieces eager-loaded.
     * Throws ModelNotFoundException if the collection does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_collection_by_id(int $id): Collection
    {
        return Collection::with('pieces')->findOrFail($id);
    }

    /**
     * Find a bare collection by ID for edit operations (no relationships needed).
     * Throws ModelNotFoundException if the collection does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_collection_for_edit(int $id): Collection
    {
        return Collection::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Create and persist a new collection from validated request data.
     *
     * @param array $collection_data Keys: name (string), creation_date (string)
     */
    public function create_collection(array $collection_data): Collection
    {
        $collection = new Collection();
        $collection->set_name($collection_data['name']);
        $collection->set_creation_date($collection_data['creation_date']);
        $collection->save();

        return $collection;
    }

    /**
     * Update an existing collection from validated request data.
     *
     * @param int   $id              The collection primary key
     * @param array $collection_data Keys: name (string), creation_date (string)
     *
     * @throws ModelNotFoundException
     */
    public function update_collection(int $id, array $collection_data): Collection
    {
        $collection = Collection::findOrFail($id);

        $collection->set_name($collection_data['name']);
        $collection->set_creation_date($collection_data['creation_date']);
        $collection->save();

        return $collection;
    }

    /**
     * Delete a collection by ID.
     *
     * Note: if pieces have a foreign key constraint on collection_id without
     * cascadeOnDelete, this will fail at the database level if the collection
     * has associated pieces. Ensure the migration handles this appropriately.
     *
     * @throws ModelNotFoundException
     */
    public function delete_collection(int $id): void
    {
        // If cascadeOnDelete is set on the pieces' collection_id foreign key, this will automatically delete associated pieces. If not, this will throw a database error if pieces exist.
        Collection::findOrFail($id)->delete();
    }
}
