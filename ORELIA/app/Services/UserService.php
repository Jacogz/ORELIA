<?php
/*
 * File: UserService.php
 * Description: Service layer for all User CRUD operations.
 *              Authentication flow (login, logout, session management) is
 *              intentionally handled in UserController — those operations
 *              are HTTP/session concerns, not user data concerns.
 */

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    // -------------------------------------------------------------------------
    // Read operations
    // -------------------------------------------------------------------------

    /**
     * Return all users.
     *
     * @return Collection<int, User>
     */
    public function get_all_users(): Collection
    {
        return User::all();
    }

    /**
     * Find a single user by ID.
     * Throws ModelNotFoundException if the user does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_user_by_id(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Find a bare user by ID for edit operations.
     * Throws ModelNotFoundException if the user does not exist.
     *
     * @throws ModelNotFoundException
     */
    public function get_user_for_edit(int $id): User
    {
        return User::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Write operations
    // -------------------------------------------------------------------------

    /**
     * Create and persist a new user from validated request data.
     *
     * Password is hashed here — the controller must never hash it beforehand
     * or store a plaintext password. Role is set from the creation data and
     * is immutable after this point — update_user cannot change it.
     *
     * @param array $user_data Keys: name (string), last_name (string),
     *                         email (string), password (string, plaintext),
     *                         role (string), address (string|null)
     */
    public function create_user(array $user_data): User
    {
        $user = new User();
        $user->set_name($user_data['name']);
        $user->set_last_name($user_data['last_name']);
        $user->set_email($user_data['email']);
        $user->set_password(Hash::make($user_data['password']));
        $user->set_role($user_data['role']);
        $user->set_address($user_data['address'] ?? '');
        $user->save();

        return $user;
    }

    /**
     * Update the editable fields of an existing user.
     *
     * Editable fields: name, last_name, address.
     * Immutable fields: email, password, role.
     *
     * Role is intentionally excluded from this method. It is set once at
     * creation and must never be changed through any update path — doing so
     * would allow privilege escalation. A dedicated admin-only role management
     * feature must be built separately if role changes are ever needed.
     *
     * @param int   $id        The user primary key
     * @param array $user_data Keys: name (string), last_name (string),
     *                         address (string|null)
     *
     * @throws ModelNotFoundException
     */
    public function update_user(int $id, array $user_data): User
    {
        $user = User::findOrFail($id);

        $user->set_name($user_data['name']);
        $user->set_last_name($user_data['last_name']);
        $user->set_address($user_data['address'] ?? '');
        $user->save();

        return $user;
    }

    /**
     * Delete a user by ID.
     *
     * @throws ModelNotFoundException
     */
    public function delete_user(int $id): void
    {
        User::findOrFail($id)->delete();
    }
}
