<?php
/*
 * Author: Isabella Hernandez Posada
 * File: UserController.php
 * Description: User controller with CRUD operations
 * Created: 2025-03-22
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display form to create a new user
     *
     * @return View
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create User';
        return view('user.create')->with('viewData', $viewData);
    }

    /**
     * Store a new user in the database
     * Validates input and creates user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        try {
            $validation_data['password'] = bcrypt($validation_data['password']);

            $user = User::create($validation_data);

            Log::info('User created', ['user_id' => $user->id]);

            return redirect()->route('users.index')
                           ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('users.create')
                           ->withErrors(['error' => 'Could not create user.']);
        }
    }

    /**
     * Display list of all users
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $viewData = [];
            $viewData['title'] = 'Users List';
            $viewData['users'] = User::all();

            return view('user.index')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::error('User list retrieval failed', ['error' => $e->getMessage()]);

            return view('user.index')->with('viewData', [
                'title' => 'Users List',
                'users' => [],
            ]);
        }
    }

    /**
     * Display details of a specific user
     *
     * @param string $id
     * @return View|RedirectResponse
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $viewData = [];
            $viewData['title'] = 'User Details';
            $viewData['user'] = User::findOrFail($id);

            return view('user.show')->with('viewData', $viewData);
        } catch (\Exception $e) {
            Log::warning('User not found', ['id' => $id]);

            return redirect()->route('users.index')
                           ->withErrors(['error' => 'User not found.']);
        }
    }

    /**
     * Delete a user from database
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            User::findOrFail($id)->delete();

            Log::info('User deleted', ['user_id' => $id]);

            return redirect()->route('users.index')
                           ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Log::error('User deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('users.index')
                           ->withErrors(['error' => 'Could not delete user.']);
        }
    }
}