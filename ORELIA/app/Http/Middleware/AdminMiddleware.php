<?php
/*
 * Author: Isabella Hernandez Posada
 * File: MaterialController.php
 * Description: Restricts access to admin routes — only authenticated admins pass through
 * Created: 2026-03-22
 */

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $current_user = Auth::user();

        // Redirect to login if not authenticated or not an admin
        if (!Auth::check() || !($current_user instanceof User) || $current_user->get_role() !== 'admin') {
            return redirect()->route('login.index');
        }

        return $next($request);
    }
}