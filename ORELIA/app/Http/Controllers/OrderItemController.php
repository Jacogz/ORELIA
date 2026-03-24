<?php
/*
 * Author: Isabella Hernandez Posada
 * File: OrderItemController.php
 * Description: OrderItem controller with CRUD operations
 * Created: 2026-03-22
 */

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class OrderItemController extends Controller
{
    /**
     * Display form to create a new order item
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create Order Item'];
        return view('orderitem.create', ['view_data' => $view_data]);
    }

    /**
     * Store a new order item in the database
     */
    public function store(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'unit_price' => 'required|integer|min:1',
            'quantity'   => 'required|integer|min:1',
            'order_id'   => 'required|integer',
            'piece_id'   => 'required|integer',
        ]);

        try {
            $validated_data['subtotal'] = $validated_data['unit_price'] * $validated_data['quantity'];

            $orderitem = OrderItem::create($validated_data);

            Log::info('Order item created', ['orderitem_id' => $orderitem->id]);

            return redirect()->route('orderitems.index')
                ->with('success', 'Order item created successfully');

        } catch (\Exception $e) {
            Log::error('Order item creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('orderitems.create')
                ->withErrors(['error' => 'Could not create order item.']);
        }
    }

    /**
     * Display list of all order items
     */
    public function index(): View
    {
        $view_data = [
            'title'      => 'Order Items List',
            'orderitems' => OrderItem::all(),
        ];

        return view('orderitem.index', ['view_data' => $view_data]);
    }

    /**
     * Display details of a specific order item
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title'     => 'Order Item Details',
                'orderitem' => OrderItem::findOrFail($id),
            ];

            return view('orderitem.show', ['view_data' => $view_data]);

        } catch (\Exception $e) {
            Log::warning('Order item not found', ['id' => $id]);

            return redirect()->route('orderitems.index')
                ->withErrors(['error' => 'Order item not found.']);
        }
    }

    /**
     * Delete an order item from database
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            OrderItem::findOrFail($id)->delete();

            Log::info('Order item deleted', ['orderitem_id' => $id]);

            return redirect()->route('orderitems.index')
                ->with('success', 'Order item deleted successfully');
                
        } catch (\Exception $e) {
            Log::error('Order item deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('orderitems.index')
                ->withErrors(['error' => 'Could not delete order item.']);
        }
    }
}