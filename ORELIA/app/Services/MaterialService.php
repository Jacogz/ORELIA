<?php
/*
 * File: MaterialService.php
 * Description: Service layer for all Material-related database operations.
 *              Controllers must not query the Material model directly —
 *              all access goes through here.
 */

namespace App\Services;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MaterialService
{
    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all materials.
     *
     * @return Collection<int, Material>
     */
    public function get_all_materials(): Collection
    {
        return Material::all();
    }

    /**
     * Find a single material by ID with its pieces eager-loaded.
     * Throws ModelNotFoundException if the material does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_material_by_id(int $id): Material
    {
        return Material::with('pieces')->findOrFail($id);
    }

    /**
     * Find a bare material by ID for edit operations (no relationships needed).
     * Throws ModelNotFoundException if the material does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_material_for_edit(int $id): Material
    {
        return Material::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Create and persist a new material from validated request data.
     *
     * @param array $material_data Keys: name (string), type (string),
     *                             description (string), color (string)
     */
    public function create_material(array $material_data): Material
    {
        $material = new Material();
        $material->set_name($material_data['name']);
        $material->set_type($material_data['type']);
        $material->set_description($material_data['description']);
        $material->set_color($material_data['color']);
        $material->save();

        return $material;
    }

    /**
     * Update an existing material from validated request data.
     *
     * @param int   $id            The material primary key
     * @param array $material_data Keys: name (string), type (string),
     *                             description (string), color (string)
     *
     * @throws ModelNotFoundException
     */
    public function update_material(int $id, array $material_data): Material
    {
        $material = Material::findOrFail($id);

        $material->set_name($material_data['name']);
        $material->set_type($material_data['type']);
        $material->set_description($material_data['description']);
        $material->set_color($material_data['color']);
        $material->save();

        return $material;
    }

    /**
     * Delete a material by ID.
     *
     * @throws ModelNotFoundException
     */
    public function delete_material(int $id): void
    {
        Material::findOrFail($id)->delete();
    }
}
