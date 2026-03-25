<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: CartController.php
 * Description: Handles HTTP request/response cycle for shopping cart.
 *              Shows orders with 'processing' status for the authenticated user.
 */

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CartController extends Controller
{
    private OrderService $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    /**
     * Display shopping cart (orders in 'processing' status for current user).
     */
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('users.login')
                ->withErrors(['error' => __('cart.login_required')]);
        }

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user_id = $user->get_id();

            $cart_items = $this->order_service->get_orders_by_status_and_client((int) $user_id, 'processing');

            $view_data = [
                'title'       => __('cart.title'),
                'cart_items'  => $cart_items,
            ];

            return view('cart.index', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::error('Failed to load shopping cart', [
                'user_id' => $user->get_id(),
                'error'   => $e->getMessage(),
            ]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => __('cart.load_error')]);
        }
    }
}
