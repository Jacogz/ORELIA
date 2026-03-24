<?php
/*
 * Author: Isabella Hernandez Posada
 * File: UserController.php
 * Description: Handles user authentication and CRUD operations
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Show the login form
     */
    public function login(): View
    {
        // Se envía $view_data['title'] para que el Blade login.blade.php funcione correctamente
        return view('auth.login', ['view_data' => ['title' => 'Login']]);
    }

    /**
     * Handle login submission
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($validation_data)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.'
            ]);
        }

        $request->session()->regenerate();
        session(['client_id' => Auth::id()]);

        Log::info('User logged in', ['user_id' => Auth::id()]);

        if (Auth::user()->get_role() === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('home.index'); 
    }

    /**
     * Logout the user
     */
    public function logout(Request $request): RedirectResponse
    {
        Log::info('User logged out', ['user_id' => Auth::id()]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }

    /**
     * Show form to create a new user
     */
    public function create(): View
    {
        return view('user.create', ['view_data' => ['title' => 'Create User']]);
    }

    /**
     * Store a new user
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
            $validation_data['password'] = Hash::make($validation_data['password']);
            $user = User::create($validation_data);

            Log::info('User created', ['user_id' => $user->id]);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');

        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('users.create')
                ->withErrors(['error' => 'User could not be created.']);
        }
    }

    /**
     * Display all users
     */
    public function index(): View
    {
        $view_data = [
            'title' => 'Users List',
            'users' => User::all(),
        ];

        return view('user.index', ['view_data' => $view_data]);
    }

    /**
     * Show a specific user
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $view_data = [
                'title' => 'User Details',
                'user'  => User::findOrFail($id),
            ];

            return view('user.show', ['view_data' => $view_data]);

        } catch (ModelNotFoundException $e) {
            Log::warning('User not found', ['id' => $id]);

            return redirect()->route('users.index')
                ->withErrors(['error' => 'User not found.']);
        }
    }

    /**
     * Delete a user
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            User::findOrFail($id)->delete();

            Log::info('User deleted', ['user_id' => $id]);

            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {
            Log::error('User deletion failed', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('users.index')
                ->withErrors(['error' => 'User could not be deleted.']);
        }
    }
}