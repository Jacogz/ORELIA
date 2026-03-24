<?php
/*
 * Author: GitHub Copilot
 * File: AdminUserController.php
 * Description: Admin-only complete CRUD for User
 * Created: 2026-03-24
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $view_data = [
            'title' => 'Admin Users',
            'users' => User::all(),
        ];

        return view('admin.user.index', ['view_data' => $view_data]);
    }

    public function create(): View
    {
        $view_data = [
            'title' => 'Admin Create User',
        ];

        return view('admin.user.create', ['view_data' => $view_data]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $validation_data['password'] = Hash::make($validation_data['password']);
            $user = User::create($validation_data);

            Log::info('Admin created user', ['user_id' => $user->get_id()]);

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');

        } catch (\Exception $e) {
            Log::error('Admin user creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('admin.users.create')->withErrors(['error' => 'User could not be created.']);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $user = User::findOrFail($id);

            $view_data = [
                'title' => 'Admin User Details',
                'user' => $user,
            ];

            return view('admin.user.show', ['view_data' => $view_data]);

        } catch (\Exception $e) {
            Log::warning('Admin user not found', ['id' => $id]);

            return redirect()->route('admin.users.index')->withErrors(['error' => 'User not found.']);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $user = User::findOrFail($id);

            $view_data = [
                'title' => 'Admin Edit User',
                'user' => $user,
            ];

            return view('admin.user.edit', ['view_data' => $view_data]);

        } catch (\Exception $e) {
            Log::warning('Admin user edit target not found', ['id' => $id]);

            return redirect()->route('admin.users.index')->withErrors(['error' => 'User not found.']);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validation_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $user = User::findOrFail($id);

            if (!empty($validation_data['password'])) {
                $validation_data['password'] = Hash::make($validation_data['password']);
            } else {
                unset($validation_data['password']);
            }

            $user->update($validation_data);

            Log::info('Admin updated user', ['user_id' => $id]);

            return redirect()->route('admin.users.show', $id)->with('success', 'User updated successfully.');

        } catch (\Exception $e) {
            Log::error('Admin user update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.users.edit', $id)->withErrors(['error' => 'User could not be updated.']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('Admin deleted user', ['user_id' => $id]);

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
            
        } catch (\Exception $e) {
            Log::error('Admin user deletion failed', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('admin.users.index')->withErrors(['error' => 'User could not be deleted.']);
        }
    }
}
