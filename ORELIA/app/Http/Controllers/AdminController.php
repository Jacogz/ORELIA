<?php
/*
 * Author: Isabella Hernandez Posada
 * File: AdminController.php
 * Description: Admin panel controller — dashboard and admin-only views
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Piece; 
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Admin dashboard — entry point for /admin
     */
    public function index(): View
    {
        $top3 = Piece::select(
        'pieces.id',
        'pieces.name',
        'pieces.price',
        'pieces.type',
        'pieces.image_url',
        'pieces.stock',
        'pieces.size',
        'pieces.weight',
        'pieces.collection_id'
    )
    ->selectRaw('SUM(orderitems.quantity) as total_sold')
    ->join('orderitems', 'pieces.id', '=', 'orderitems.piece_id')
    ->groupBy(
        'pieces.id',
        'pieces.name',
        'pieces.price',
        'pieces.type',
        'pieces.image_url',
        'pieces.stock',
        'pieces.size',
        'pieces.weight',
        'pieces.collection_id'
    )
    ->orderByDesc('total_sold')
    ->take(3)
    ->get();

        $view_data = [
            'title'      => 'Admin Dashboard',
            'admin_name' => Auth::user() ? Auth::user()->get_name() : 'Admin',
            'top3'       => $top3,    
        ];

        return view('admin.index', ['view_data' => $view_data]);
    }
}