<?php
/*
 * Author: Isabella Hernandez Posada
 * File: User.php
 * Description: User model with getters/setters, relationships, and authentication
 * Created: 2025-03-22
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->id;
    }

    /**
     * Get the user name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * Get the user last name
     *
     * @return string
     */
    public function get_last_name(): string
    {
        return $this->last_name;
    }

    /**
     * Get the user email
     *
     * @return string
     */
    public function get_email(): string
    {
        return $this->email;
    }

    /**
     * Get the user password (hashed)
     *
     * @return string
     */
    public function get_password(): string
    {
        return $this->password;
    }

    /**
     * Get the user role
     *
     * @return string
     */
    public function get_role(): string
    {
        return $this->role;
    }

    /**
     * Get the user address (nullable)
     *
     * @return string
     */
    public function get_address(): string
    {
        return $this->address ?? '';
    }

    /**
     * Set the user name
     *
     * @param string $name
     * @return void
     */
    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Set the user last name
     *
     * @param string $last_name
     * @return void
     */
    public function set_last_name(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * Set the user email
     *
     * @param string $email
     * @return void
     */
    public function set_email(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Set the user password (will be hashed)
     *
     * @param string $password
     * @return void
     */
    public function set_password(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Set the user role
     *
     * @param string $role
     * @return void
     */
    public function set_role(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Set the user address
     *
     * @param string $address
     * @return void
     */
    public function set_address(string $address): void
    {
        $this->address = $address;
    }

    /**
     * Get all orders for this user
     * One user has many orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Authenticate user with email and password
     * Checks if user exists and password matches
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function authenticate(string $email, string $password): bool
    {
        $user = static::where('email', $email)->first();
        return $user && \Hash::check($password, $user->password);
    }
}