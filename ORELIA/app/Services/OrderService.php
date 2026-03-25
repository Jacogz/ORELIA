<?php
/*
 * File: OrderService.php
 * Description: Service layer for all Order-related database operations and business logic.
 *              Controllers must not query the Order model directly — all access goes through here.
 */

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Piece;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Status assigned to every newly created order.
     * Centralised here so a future change touches one line.
     */
    private const DEFAULT_STATUS = 'pending';

    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all orders with their client relationship eager-loaded.
     *
     * @return Collection<int, Order>
     */
    public function get_all_orders(): Collection
    {
        return Order::with('client')->get();
    }

    /**
     * Find a single order by ID with client and order items eager-loaded.
     * Throws ModelNotFoundException if the order does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_order_by_id(int $id): Order
    {
        return Order::with(['client', 'order_items'])->findOrFail($id);
    }

    /**
     * Find a bare order by ID for edit operations (no relationships needed).
     * Throws ModelNotFoundException if the order does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_order_for_edit(int $id): Order
    {
        return Order::findOrFail($id);
    }

    /**
     * Get all orders for a specific client with a specific status.
     *
     * @param int    $client_id The client user ID
     * @param string $status    The order status (e.g., 'processing', 'in_transit', 'completed')
     *
     * @return Collection<int, Order>
     */
    public function get_orders_by_status_and_client(int $client_id, string $status): Collection
    {
        return Order::where('client_id', $client_id)
            ->where('status', $status)
            ->with(['client', 'order_items'])
            ->get();
    }

    /**
     * Get all orders for a specific client with any of the specified statuses.
     * More efficient than making multiple queries when filtering by multiple statuses.
     *
     * @param int   $client_id The client user ID
     * @param array $statuses  Array of order statuses (e.g., ['in_transit', 'completed'])
     *
     * @return Collection<int, Order>
     */
    public function get_orders_by_statuses_and_client(int $client_id, array $statuses): Collection
    {
        return Order::where('client_id', $client_id)
            ->whereIn('status', $statuses)
            ->with(['client', 'order_items'])
            ->get();
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Create a complete order — the order record and all its items — in a
     * single atomic transaction. If any step fails the entire operation is
     * rolled back so the database is never left in a partial state.
     *
     * Total is calculated from the provided items, never trusted from input.
     * Status is always set to DEFAULT_STATUS by the service.
     *
     * @param array $order_data Keys: client_id (int), payment_method (string),
     *                          payment_status (string), creation_date (string),
     *                          items (array of ['piece_id' => int, 'quantity' => int])
     *
     * @throws \Throwable
     */
    public function create_order(array $order_data): Order
    {
        return DB::transaction(function () use ($order_data) {
            // Calculate the order total from pieces before creating anything
            $total = $this->calculate_total_from_items($order_data['items']);

            $order = new Order();
            $order->set_client_id($order_data['client_id']);
            $order->set_status(self::DEFAULT_STATUS);
            $order->set_payment_method($order_data['payment_method']);
            $order->set_payment_status($order_data['payment_status']);
            $order->set_creation_date($order_data['creation_date']);
            $order->set_total($total);
            $order->save();

            // Persist each item now that we have the order ID
            foreach ($order_data['items'] as $item) {
                $piece      = Piece::findOrFail($item['piece_id']);
                $unit_price = $piece->get_price();
                $quantity   = (int) $item['quantity'];
                $subtotal   = $unit_price * $quantity;

                $order_item = new OrderItem();
                $order_item->set_order_id($order->get_id());
                $order_item->set_piece_id($piece->get_id());
                $order_item->set_unit_price($unit_price);
                $order_item->set_quantity($quantity);
                $order_item->set_subtotal($subtotal);
                $order_item->save();
            }

            return $order;
        });
    }

    /**
     * Update the lifecycle fields of an existing order.
     *
     * Only status and payment_status may change after creation — client,
     * total, items, and payment_method are immutable once the order exists.
     *
     * @param int   $id         The order primary key
     * @param array $order_data Keys: status (string), payment_status (string)
     *
     * @throws ModelNotFoundException
     */
    public function update_order(int $id, array $order_data): Order
    {
        $order = Order::findOrFail($id);

        $order->set_status($order_data['status']);
        $order->set_payment_status($order_data['payment_status']);
        $order->save();

        return $order;
    }

    /**
     * Delete an order by ID.
     * Order items are removed automatically via cascadeOnDelete on the migration.
     *
     * @throws ModelNotFoundException
     */
    public function delete_order(int $id): void
    {
        Order::findOrFail($id)->delete();
    }

    // -------------------------------------------------------------------------
    // Business logic (moved from Order model)
    // -------------------------------------------------------------------------

    /**
     * Calculate the total for a set of items before order creation.
     *
     * Fetches the current price of each piece from the database so the total
     * is always based on live prices, never on client-submitted values.
     *
     * @param array $items Array of ['piece_id' => int, 'quantity' => int]
     */
    public function calculate_total_from_items(array $items): int
    {
        $total = 0;

        foreach ($items as $item) {
            $piece     = Piece::findOrFail($item['piece_id']);
            $total    += $piece->get_price() * (int) $item['quantity'];
        }

        return $total;
    }

    /**
     * Calculate the total from an order's already-loaded order items.
     *
     * Use this when the order is already in memory and its items are
     * eager-loaded — avoids re-querying the database.
     */
    public function calculate_total_from_order(Order $order): int
    {
        $total       = 0;
        $order_items = $order->get_order_items();

        foreach ($order_items as $order_item) {
            if ($order_item instanceof OrderItem) {
                $total += $order_item->get_subtotal();
            }
        }

        return $total;
    }
}
