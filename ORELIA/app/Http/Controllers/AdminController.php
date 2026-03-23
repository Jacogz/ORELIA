<?php
/*
 * Author: Isabella Hernandez Posada
 * File: AdminController.php
 * Description: Admin panel controller — dashboard and admin-only views
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Admin dashboard — entry point for /admin
     */
    public function index(): View
    {
        $view_data = [
            'title'      => 'Admin Dashboard',
            'admin_name' => Auth::user()->get_name(),
        ];

        return view('admin.index', $view_data);
    }
}