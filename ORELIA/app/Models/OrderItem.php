<?php
/*
 * Author: Isabella Hernandez Posada
 * File: OrderItem.php
 * Description: OrderItem model with getters/setters and relationships
 * Created: 2025-03-22
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderitems';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'unit_price',
        'quantity',
        'subtotal',
        'order_id',
        'piece_id',
    ];

    /**
     * Get the order item ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->id;
    }

    /**
     * Get the unit price
     *
     * @return int
     */
    public function get_unit_price(): int
    {
        return $this->unit_price;
    }

    /**
     * Get the quantity
     *
     * @return int
     */
    public function get_quantity(): int
    {
        return $this->quantity;
    }

    /**
     * Get the subtotal
     *
     * @return int
     */
    public function get_subtotal(): int
    {
        return $this->subtotal;
    }

    /**
     * Get the order ID
     *
     * @return int
     */
    public function get_order_id(): int
    {
        return $this->order_id;
    }

    /**
     * Get the piece ID
     *
     * @return int
     */
    public function get_piece_id(): int
    {
        return $this->piece_id;
    }

    /**
     * Set the unit price
     *
     * @param int $unit_price
     * @return void
     */
    public function set_unit_price(int $unit_price): void
    {
        $this->unit_price = $unit_price;
    }

    /**
     * Set the quantity
     *
     * @param int $quantity
     * @return void
     */
    public function set_quantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Set the subtotal
     *
     * @param int $subtotal
     * @return void
     */
    public function set_subtotal(int $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Set the order ID
     *
     * @param int $order_id
     * @return void
     */
    public function set_order_id(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * Set the piece ID
     *
     * @param int $piece_id
     * @return void
     */
    public function set_piece_id(int $piece_id): void
    {
        $this->piece_id = $piece_id;
    }

    /**
     * Get the order associated with this order item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the piece associated with this order item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function piece()
    {
        return $this->belongsTo('App\Models\Piece');
    }

    /**
     * Calculate subtotal based on unit price and quantity
     *
     * @return int
     */
    public function calculate_subtotal(): int
    {
        return $this->unit_price * $this->quantity;
    }
}