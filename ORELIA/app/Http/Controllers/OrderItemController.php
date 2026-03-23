<?php
/*
 * Author: Isabella Hernandez Posada
 * File: OrderItemController.php
 * Description: OrderItem controller with CRUD operations
 * Created: 2025-03-22
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
     *
     * @return View
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Order Item';
        return view('orderitem.create')->with('viewData', $viewData);
    }

    /**
     * Store a new order item in the database
     * Validates input and calculates subtotal
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'unit_price' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'order_id' => 'required|integer',
            'piece_id' => 'required|integer',
        ]);

        try {
            $unit_price = $validation_data['unit_price'];
            $quantity = $validation_data['quantity'];
            $subtotal = $unit_price * $quantity;

            $validation_data['subtotal'] = $subtotal;

            $orderitem = OrderItem::create($validation_data);

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
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Order Items List';
            $viewData['orderitems'] = OrderItem::all();

            return view('orderitem.index')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::error('Order items list retrieval failed', ['error' => $e->getMessage()]);

            return view('orderitem.index')->with('viewData', [
                'title' => 'Order Items List',
                'orderitems' => [],
            ]);
        }
    }

    /**
     * Display details of a specific order item
     *
     * @param string $id
     * @return View|RedirectResponse
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Order Item Details';
            $viewData['orderitem'] = OrderItem::findOrFail($id);

            return view('orderitem.show')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::warning('Order item not found', ['id' => $id]);

            return redirect()->route('orderitems.index')
                           ->withErrors(['error' => 'Order item not found.']);
        }
    }

    /**
     * Delete an order item from database
     *
     * @param string $id
     * @return RedirectResponse
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