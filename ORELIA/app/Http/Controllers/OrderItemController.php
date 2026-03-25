<?php
/*
 * Author: Isabella Hernandez Posada-Jacobo Giraldo Zuluaga
 * File: OrderItemController.php
 * Description: Handles HTTP request/response cycle for OrderItem resources.
 *              All model interaction is delegated to OrderItemService.
 *              Order item creation is handled exclusively by OrderService —
 *              items cannot be created in isolation through this controller.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderItemService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OrderItemController extends Controller
{
    private OrderItemService $order_item_service;

    public function __construct()
    {
        $this->order_item_service = new OrderItemService();
    }

    // -------------------------------------------------------------------------
    // Read routes
    // -------------------------------------------------------------------------

    /**
     * Display all order items with their order and piece relationships.
     */
    public function index(): View
    {
        $view_data = [
            'title'       => 'Order Items',
            'order_items' => $this->order_item_service->get_all_order_items(),
        ];

        return view('orderitems.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single order item with its order and piece.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $order_item = $this->order_item_service->get_order_item_by_id((int) $id);

            $view_data = [
                'title'      => 'Order Item Details',
                'order_item' => $order_item,
            ];

            return view('orderitems.show', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Order item not found', ['id' => $id]);

            return redirect()->route('orderitems.index')
                ->withErrors(['error' => 'Order item not found.']);
        }
    }

    // -------------------------------------------------------------------------
    // Write routes
    // -------------------------------------------------------------------------

    /**
     * Show the edit order item form.
     * Only quantity is editable — subtotal is recalculated by the service.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $order_item = $this->order_item_service->get_order_item_for_edit((int) $id);

            $view_data = [
                'title'      => 'Edit Order Item',
                'order_item' => $order_item,
            ];

            return view('orderitems.edit', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Order item not found for editing', ['id' => $id]);

            return redirect()->route('orderitems.index')
                ->withErrors(['error' => 'Order item not found.']);
        }
    }

    /**
     * Validate and apply a quantity update to an existing order item.
     * Subtotal is recomputed by the service from the stored unit_price.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $order_item = $this->order_item_service->update_order_item((int) $id, $validation_data);

            Log::info('Order item updated', [
                'order_item_id' => $order_item->get_id(),
                'quantity'      => $order_item->get_quantity(),
                'subtotal'      => $order_item->get_subtotal(),
            ]);

            return redirect()->route('orderitems.show', ['id' => $id])
                ->with('success', 'Order item updated successfully.');
        } catch (\Exception $e) {
            Log::error('Order item update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('orderitems.edit', ['id' => $id])
                ->withErrors(['error' => 'Order item could not be updated.']);
        }
    }

    /**
     * Delete an order item by ID.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->order_item_service->delete_order_item((int) $id);

            Log::info('Order item deleted', ['order_item_id' => $id]);

            return redirect()->route('orderitems.index')
                ->with('success', 'Order item deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Order item deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('orderitems.index')
                ->withErrors(['error' => 'Order item could not be deleted.']);
        }
    }
}
