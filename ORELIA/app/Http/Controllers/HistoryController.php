<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: HistoryController.php
 * Description: Handles HTTP request/response cycle for order history.
 *              Shows orders with 'in_transit' or 'completed' status for the authenticated user.
 */

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HistoryController extends Controller
{
    private OrderService $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    /**
     * Display order history (orders with 'in_transit' or 'completed' status for current user).
     */
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('users.login')
                ->withErrors(['error' => __('history.login_required')]);
        }

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user_id = $user->get_id();

            // Get orders with 'in_transit' or 'completed' status
            $history_orders = $this->order_service->get_orders_by_statuses_and_client(
                (int) $user_id,
                ['in_transit', 'completed']
            );

            $view_data = [
                'title'  => __('history.title'),
                'orders' => $history_orders,
            ];

            return view('history.index', ['view_data' => $view_data]);
        } catch (\Exception $e) {
            Log::error('Failed to load order history', [
                'user_id' => $user->get_id(),
                'error'   => $e->getMessage(),
            ]);

            return redirect()->route('pieces.index')
                ->withErrors(['error' => __('history.load_error')]);
        }
    }
}
