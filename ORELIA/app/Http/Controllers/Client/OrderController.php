<?php
/*
 * Author: GitHub Copilot
 * File: OrderController.php
 * Description: Final-user read-only controller for orders
 * Created: 2026-03-24
 */

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display all orders (read-only)
     */
    public function index(): View
    {
        $view_data = [
            'title' => 'Orders',
            'orders' => Order::with('client')->get(),
        ];

        return view('order.index', ['viewData' => $view_data]);
    }

    /**
     * Show a single order (read-only)
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $order = Order::with(['client', 'order_items'])->findOrFail($id);

            $view_data = [
                'title' => 'Order Details',
                'order' => $order,
            ];

            return view('order.show', ['viewData' => $view_data]);
        } catch (\Exception $e) {
            Log::warning('Order not found', ['id' => $id]);

            return redirect()->route('orders.index')
                ->withErrors(['error' => 'Order not found.']);
        }
    }
}
