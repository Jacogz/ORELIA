<?php
/*
 * File: OrderItemService.php
 * Description: Service layer for OrderItem read, update, and delete operations.
 *              Order item creation is intentionally excluded — items are only
 *              ever created as part of a full order through OrderService.
 */

namespace App\Services;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderItemService
{
    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all order items with their order and piece relationships eager-loaded.
     *
     * @return Collection<int, OrderItem>
     */
    public function get_all_order_items(): Collection
    {
        return OrderItem::with(['order', 'piece'])->get();
    }

    /**
     * Find a single order item by ID with its order and piece eager-loaded.
     * Throws ModelNotFoundException if the item does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_order_item_by_id(int $id): OrderItem
    {
        return OrderItem::with(['order', 'piece'])->findOrFail($id);
    }

    /**
     * Find a bare order item by ID for edit operations.
     * Throws ModelNotFoundException if the item does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_order_item_for_edit(int $id): OrderItem
    {
        return OrderItem::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Update the quantity of an existing order item and recompute its subtotal.
     *
     * unit_price, order_id, and piece_id are immutable after creation.
     * subtotal is always recalculated from the stored unit_price — never
     * trusted from the request.
     *
     * @param int   $id              The order item primary key
     * @param array $order_item_data Keys: quantity (int)
     *
     * @throws ModelNotFoundException
     */
    public function update_order_item(int $id, array $order_item_data): OrderItem
    {
        $order_item = OrderItem::findOrFail($id);

        $quantity = (int) $order_item_data['quantity'];
        // Recalculate subtotal from the stored unit_price — never from input
        $subtotal = $order_item->get_unit_price() * $quantity;

        $order_item->set_quantity($quantity);
        $order_item->set_subtotal($subtotal);
        $order_item->save();

        return $order_item;
    }

    /**
     * Delete an order item by ID.
     *
     * @throws ModelNotFoundException
     */
    public function delete_order_item(int $id): void
    {
        OrderItem::findOrFail($id)->delete();
    }
}
