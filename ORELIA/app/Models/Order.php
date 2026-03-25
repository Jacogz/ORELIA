<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: Order.php
 * Description: Order model with getters/setters and total calculation
 * Created: 2026-03-23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key
     * $this->attributes['total'] - int - contains the order total
     * $this->attributes['creation_date'] - datetime - contains the order creation date
     * $this->attributes['status'] - string - contains the order status
     * $this->attributes['client_id'] - int - contains the client user ID
     * $this->attributes['payment_method'] - string - contains the payment method
     * $this->attributes['payment_status'] - string - contains the payment status
     * client - User - contains the order client object
     * order_items - OrderItem[] - contains the order items list
     */

    protected $fillable = [
        'total',
        'creation_date',
        'status',
        'client_id',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'total' => 'integer',
        'creation_date' => 'datetime',
        'client_id' => 'integer',
    ];

    /**
     * Get the order ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get the order total
     *
     * @return int
     */
    public function get_total(): int
    {
        return $this->attributes['total'];
    }

    /**
     * Get the creation date
     *
     * @return string
     */
    public function get_creation_date(): string
    {
        return $this->attributes['creation_date'];
    }

    /**
     * Get the order status
     *
     * @return string
     */
    public function get_status(): string
    {
        return $this->attributes['status'];
    }

    /**
     * Get the client ID
     *
     * @return int
     */
    public function get_client_id(): int
    {
        return $this->attributes['client_id'];
    }

    /**
     * Get the payment method
     *
     * @return string
     */
    public function get_payment_method(): string
    {
        return $this->attributes['payment_method'];
    }

    /**
     * Get the payment status
     *
     * @return string
     */
    public function get_payment_status(): string
    {
        return $this->attributes['payment_status'];
    }

    /**
     * Get the order client
     *
     * @return User|null
     */
    public function get_client(): ?User
    {
        if (!$this->relationLoaded('client')) {
            return null;
        }

        $client = $this->getRelation('client');

        return $client instanceof User ? $client : null;
    }

    /**
     * Get the order items
     *
     * @return array
     */
    public function get_order_items(): array
    {
        if (!$this->relationLoaded('order_items')) {
            return [];
        }

        $order_items = $this->getRelation('order_items');

        if ($order_items instanceof SupportCollection) {
            return $order_items->all();
        }

        return is_array($order_items) ? $order_items : [];
    }

    /**
     * Set the order ID
     *
     * @param int $id
     * @return void
     */
    public function set_id(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    /**
     * Set the order total
     *
     * @param int $total
     * @return void
     */
    public function set_total(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    /**
     * Set the creation date
     *
     * @param string $creation_date
     * @return void
     */
    public function set_creation_date(string $creation_date): void
    {
        $this->attributes['creation_date'] = $creation_date;
    }

    /**
     * Set the order status
     *
     * @param string $status
     * @return void
     */
    public function set_status(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    /**
     * Set the client ID
     *
     * @param int $client_id
     * @return void
     */
    public function set_client_id(int $client_id): void
    {
        $this->attributes['client_id'] = $client_id;
    }

    /**
     * Set the payment method
     *
     * @param string $payment_method
     * @return void
     */
    public function set_payment_method(string $payment_method): void
    {
        $this->attributes['payment_method'] = $payment_method;
    }

    /**
     * Set the payment status
     *
     * @param string $payment_status
     * @return void
     */
    public function set_payment_status(string $payment_status): void
    {
        $this->attributes['payment_status'] = $payment_status;
    }

    /**
     * Set the order client
     *
     * @param User $client
     * @return void
     */
    public function set_client(User $client): void
    {
        $this->set_client_id($client->get_id());
        $this->setRelation('client', $client);
    }

    /**
     * Set the order items
     *
     * @param array $order_items
     * @return void
     */
    public function set_order_items(array $order_items): void
    {
        $this->setRelation('order_items', collect($order_items));
    }

    /**
     * Get the client associated with this order
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo('App\\Models\\User', 'client_id');
    }

    /**
     * Get the order items associated with this order
     *
     * @return HasMany
     */
    public function order_items(): HasMany
    {
        return $this->hasMany('App\\Models\\OrderItem');
    }
}
