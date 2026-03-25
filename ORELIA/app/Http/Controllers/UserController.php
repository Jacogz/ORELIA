<?php
/*
 * File: UserController.php
 * Description: Handles HTTP request/response cycle for User resources and
 *              authentication flow. CRUD operations are delegated to UserService.
 *              Authentication (login, logout, session) is handled here directly
 *              as these are HTTP/session concerns, not user data concerns.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $user_service;

    public function __construct()
    {
        $this->user_service = new UserService();
    }

    // -------------------------------------------------------------------------
    // Authentication routes (controller-owned — session/HTTP concerns)
    // -------------------------------------------------------------------------

    /**
     * Show the login form.
     */
    public function login(): View
    {
        $view_data = ['title' => 'Login'];

        return view('auth.login', ['view_data' => $view_data]);
    }

    /**
     * Handle login form submission.
     * On success, stores only the client ID in session — R13.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($validation_data)) {
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }

        $request->session()->regenerate();
        session(['client_id' => Auth::id()]);

        Log::info('User logged in', ['user_id' => Auth::id()]);

        $current_user = Auth::user();

        if ($current_user instanceof User && $current_user->get_role() === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('pieces.index');
    }

    /**
     * Log out the current user and invalidate the session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Log::info('User logged out', ['user_id' => Auth::id()]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.login');
    }

    // -------------------------------------------------------------------------
    // Admin CRUD routes (delegated to UserService)
    // -------------------------------------------------------------------------

    /**
     * Display all users.
     */
    public function index(): View
    {
        $view_data = [
            'title' => 'Users List',
            'users' => $this->user_service->get_all_users(),
        ];

        return view('users.index', ['view_data' => $view_data]);
    }

    /**
     * Show a specific user.
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title' => 'User Details',
                'user'  => $this->user_service->get_user_by_id((int) $id),
            ];

            return view('users.show', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('User not found', ['id' => $id]);

            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'User not found.']);
        }
    }

    /**
     * Show the create user form.
     */
    public function create(): View
    {
        $view_data = ['title' => 'Create User'];

        return view('users.create', ['view_data' => $view_data]);
    }

    /**
     * Validate and persist a new user.
     * Password hashing is handled by UserService — never hash before passing.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'role'      => ['required', 'string', 'max:50'],
            'address'   => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $user = $this->user_service->create_user($validation_data);

            Log::info('User created', ['user_id' => $user->get_id()]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('admin.users.create')
                ->withErrors(['error' => 'User could not be created.']);
        }
    }

    /**
     * Show the edit user form.
     * Role, email, and password are not editable through this form.
     */
    public function edit(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title' => 'Edit User',
                'user'  => $this->user_service->get_user_for_edit((int) $id),
            ];

            return view('users.edit', ['view_data' => $view_data]);
        } catch (ModelNotFoundException $e) {
            Log::warning('User not found for editing', ['id' => $id]);

            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'User not found.']);
        }
    }

    /**
     * Validate and apply updates to an existing user.
     * Only name, last_name, and address are accepted — role is immutable.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address'   => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $user = $this->user_service->update_user((int) $id, $validation_data);

            Log::info('User updated', ['user_id' => $user->get_id()]);

            return redirect()->route('admin.users.show', ['id' => $id])
                ->with('success', 'User updated successfully.');
        } catch (ModelNotFoundException $e) {
            Log::warning('User not found for update', ['id' => $id]);

            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'User not found.']);
        } catch (\Exception $e) {
            Log::error('User update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.users.edit', ['id' => $id])
                ->withErrors(['error' => 'User could not be updated.']);
        }
    }

    /**
     * Delete a user by ID.
     */
    public function delete(string $id): RedirectResponse
    {
        try {
            $this->user_service->delete_user((int) $id);

            Log::info('User deleted', ['user_id' => $id]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('User deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'User could not be deleted.']);
        }
    }
}
