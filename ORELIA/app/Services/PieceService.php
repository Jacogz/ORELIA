<?php
/*
 * File: PieceService.php
 * Author: Jacobo Giraldo
 * Description: Service layer for all Piece-related database operations and business logic.
 *              Controllers must not query the Piece model directly — all access goes through here.
 */

namespace App\Services;

use App\Models\Piece;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PieceService
{
    /**
     * Default image path used when no image_url is provided on creation.
     */
    private const DEFAULT_IMAGE_URL = '/images/default.svg';

    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all pieces with their collection relationship eager-loaded.
     *
     * @return Collection<int, Piece>
     */
    public function get_all_pieces(): Collection
    {
        return Piece::with('collection')->get();
    }

    /**
     * Find a single piece by ID with all display relationships eager-loaded.
     * Throws ModelNotFoundException if the piece does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_piece_by_id(int $id): Piece
    {
        return Piece::with(['collection', 'materials', 'order_items'])->findOrFail($id);
    }

    /**
     * Find a bare piece by ID (no relationships) for edit operations.
     * Throws ModelNotFoundException if the piece does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_piece_for_edit(int $id): Piece
    {
        return Piece::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Create and persist a new piece from validated request data.
     *
     * Applies the default image URL when image_url is absent or empty.
     * All field assignments go through the model's setters to honour R12.
     *
     * @param array $piece_data Keys: name, price, type, image_url (optional),
     *                          size, stock, weight, collection_id
     */
    public function create_piece(array $piece_data): Piece
    {
        // Apply default image before touching the model
        $image_url = (!empty($piece_data['image_url']))
            ? $piece_data['image_url']
            : url(self::DEFAULT_IMAGE_URL);

        $piece = new Piece();
        $piece->set_name($piece_data['name']);
        $piece->set_price($piece_data['price']);
        $piece->set_type($piece_data['type']);
        $piece->set_image_url($image_url);
        $piece->set_size($piece_data['size']);
        $piece->set_stock($piece_data['stock']);
        $piece->set_weight($piece_data['weight']);
        $piece->set_collection_id($piece_data['collection_id']);
        $piece->save();

        return $piece;
    }

    /**
     * Update an existing piece from validated request data.
     *
     * Fetches the piece internally so the controller never holds a stale
     * model reference across the service boundary.
     * All field assignments go through the model's setters to honour R12.
     *
     * @param int   $id         The piece primary key
     * @param array $piece_data Keys: name, price, type, image_url (optional),
     *                          size, stock, weight, collection_id
     *
     * @throws ModelNotFoundException
     */
    public function update_piece(int $id, array $piece_data): Piece
    {
        $piece = Piece::findOrFail($id);

        // Only replace the image when a new one is explicitly provided
        $image_url = (!empty($piece_data['image_url']))
            ? $piece_data['image_url']
            : $piece->get_image_url();

        $piece->set_name($piece_data['name']);
        $piece->set_price($piece_data['price']);
        $piece->set_type($piece_data['type']);
        $piece->set_image_url($image_url);
        $piece->set_size($piece_data['size']);
        $piece->set_stock($piece_data['stock']);
        $piece->set_weight($piece_data['weight']);
        $piece->set_collection_id($piece_data['collection_id']);
        $piece->save();

        return $piece;
    }

    /**
     * Delete a piece by ID.
     *
     * @throws ModelNotFoundException
     */
    public function delete_piece(int $id): void
    {
        Piece::findOrFail($id)->delete();
    }
}
