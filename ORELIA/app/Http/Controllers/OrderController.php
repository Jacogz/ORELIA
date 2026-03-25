<?php
/* 
 * Author: Jacobo Giraldo Zuluaga-Jeremias Figueroa Garcia 
 * File: OrderController.php
 * Description: Handles HTTP request/response cycle for Order resources.
 *              All model interaction is delegated to OrderService.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OrderController extends Controller
{
    private OrderService $order_service;

    public function __construct()
    {
        $this->order_service = new OrderService();
    }

    // -------------------------------------------------------------------------
    // Public read routes
    // -------------------------------------------------------------------------

    /**
     * Display all orders with their client relationship.
     * Access control will be applied here once authentication is implemented.
     */
    public function index(): View
    {
        $view_data = [
            'title'  => 'Orders',
            'orders' => $this->order_service->get_all_orders(),
        ];

        return view('orders.index', ['view_data' => $view_data]);
    }

    /**
     * Show a single order with its client and order items.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $order = $this->order_service->get_order_by_id((int) $id);

            $view_data = [
                'title' => 'Order Details',
                'order' => $order,
            ];

            return view('orders.show', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Order not found', ['id' => $id]);

            return redirect()->route('orders.index')
                ->withErrors(['error' => 'Order not found.']);
        }
    }

    // -------------------------------------------------------------------------
    // Write routes
    // -------------------------------------------------------------------------

    /**
     * Show the create order form.
     */
    public function create(): View
    {
        $view_data = ['title' => 'Place Order'];

        return view('orders.create', ['view_data' => $view_data]);
    }

    /**
     * Validate and persist a new complete order.
     *
     * client_id is taken from the session — never from the request — so a
     * user cannot place an order on behalf of another client.
     * Total and status are set by the service, not the request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'payment_method'        => ['required', 'string', 'max:100'],
            'payment_status'        => ['required', 'string', 'max:100'],
            'creation_date'         => ['required', 'date'],
            'items'                 => ['required', 'array', 'min:1'],
            'items.*.piece_id'      => ['required', 'integer', 'exists:pieces,id'],
            'items.*.quantity'      => ['required', 'integer', 'min:1'],
        ]);

        // Inject the authenticated client ID from the session — R13
        $validation_data['client_id'] = session('client_id');

        try {
            $order = $this->order_service->create_order($validation_data);

            Log::info('Order created', [
                'order_id'  => $order->get_id(),
                'client_id' => $order->get_client_id(),
                'total'     => $order->get_total(),
            ]);

            return redirect()->route('orders.show', ['id' => $order->get_id()])
                ->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            Log::error('Order creation failed', [
                'client_id' => session('client_id'),
                'error'     => $e->getMessage(),
            ]);

            return redirect()->route('orders.create')
                ->withErrors(['error' => 'Order could not be placed.']);
        }
    }

    /**
     * Show the edit order form.
     * Only status and payment_status are editable after creation.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $order = $this->order_service->get_order_for_edit((int) $id);

            $view_data = [
                'title' => 'Edit Order',
                'order' => $order,
            ];

            return view('orders.edit', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Order not found for editing', ['id' => $id]);

            return redirect()->route('orders.index')
                ->withErrors(['error' => 'Order not found.']);
        }
    }

    /**
     * Validate and apply lifecycle updates to an existing order.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'status'         => ['required', 'string', 'max:100'],
            'payment_status' => ['required', 'string', 'max:100'],
        ]);

        try {
            $order = $this->order_service->update_order((int) $id, $validation_data);

            Log::info('Order updated', ['order_id' => $order->get_id()]);

            return redirect()->route('orders.show', ['id' => $id])
                ->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            Log::error('Order update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('orders.edit', ['id' => $id])
                ->withErrors(['error' => 'Order could not be updated.']);
        }
    }

    /**
     * Delete an order by ID.
     * Order items are removed automatically via cascade.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->order_service->delete_order((int) $id);

            Log::info('Order deleted', ['order_id' => $id]);

            return redirect()->route('orders.index')
                ->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Order deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('orders.index')
                ->withErrors(['error' => 'Order could not be deleted.']);
        }
    }
}
