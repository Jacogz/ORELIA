<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: Piece.php
 * Description: Piece model with getters/setters
 * Created: 2026-03-23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;

class Piece extends Model
{
    /**
     * PIECE ATTRIBUTES
     * $this->attributes['id'] - int - contains the piece primary key
     * $this->attributes['name'] - string - contains the piece name
     * $this->attributes['price'] - int - contains the piece price
     * $this->attributes['type'] - string - contains the piece type
     * $this->attributes['image_url'] - string - contains the piece image URL
     * $this->attributes['stock'] - int - contains the piece stock
     * $this->attributes['size'] - string - contains the piece size
     * $this->attributes['weight'] - int - contains the piece weight
    * $this->attributes['collection_id'] - int - contains the piece collection ID
     * collection - Collection - contains the piece collection object
     * materials - Material[] - contains the piece materials list
     * order_items - OrderItem[] - contains the piece order items list
     */

    protected $fillable = [
        'name',
        'price',
        'type',
        'image_url',
        'stock',
        'size',
        'weight',
        'collection_id',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'weight' => 'integer',
        'collection_id' => 'integer',
    ];

    /**
     * Get the piece ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get the piece name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Get the piece price
     *
     * @return int
     */
    public function get_price(): int
    {
        return $this->attributes['price'];
    }

    /**
     * Get the piece type
     *
     * @return string
     */
    public function get_type(): string
    {
        return $this->attributes['type'];
    }

    /**
     * Get the piece image URL
     *
     * @return string
     */
    public function get_image_url(): string
    {
        return $this->attributes['image_url'];
    }

    /**
     * Get the piece stock
     *
     * @return int
     */
    public function get_stock(): int
    {
        return $this->attributes['stock'];
    }

    /**
     * Get the piece size
     *
     * @return string
     */
    public function get_size(): string
    {
        return $this->attributes['size'];
    }

    /**
     * Get the piece weight
     *
     * @return int
     */
    public function get_weight(): int
    {
        return $this->attributes['weight'];
    }

    /**
     * Get the piece collection
     *
     * @return Collection|null
     */
    public function get_collection(): ?Collection
    {
        if (!$this->relationLoaded('collection')) {
            return null;
        }

        $collection = $this->getRelation('collection');

        return $collection instanceof Collection ? $collection : null;
    }

    /**
     * Get the piece collection ID
     *
     * @return int
     */
    public function get_collection_id(): int
    {
        return $this->attributes['collection_id'];
    }

    /**
     * Get the piece materials
     *
     * @return array
     */
    public function get_materials(): array
    {
        if (!$this->relationLoaded('materials')) {
            return [];
        }

        $materials = $this->getRelation('materials');

        if ($materials instanceof SupportCollection) {
            return $materials->all();
        }

        return is_array($materials) ? $materials : [];
    }

    /**
     * Get the piece order items
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
     * Set the piece ID
     *
     * @param int $id
     * @return void
     */
    public function set_id(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    /**
     * Set the piece name
     *
     * @param string $name
     * @return void
     */
    public function set_name(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * Set the piece price
     *
     * @param int $price
     * @return void
     */
    public function set_price(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    /**
     * Set the piece type
     *
     * @param string $type
     * @return void
     */
    public function set_type(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    /**
     * Set the piece image URL
     *
     * @param string $image_url
     * @return void
     */
    public function set_image_url(string $image_url): void
    {
        $this->attributes['image_url'] = $image_url;
    }

    /**
     * Set the piece stock
     *
     * @param int $stock
     * @return void
     */
    public function set_stock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    /**
     * Set the piece size
     *
     * @param string $size
     * @return void
     */
    public function set_size(string $size): void
    {
        $this->attributes['size'] = $size;
    }

    /**
     * Set the piece weight
     *
     * @param int $weight
     * @return void
     */
    public function set_weight(int $weight): void
    {
        $this->attributes['weight'] = $weight;
    }

    /**
     * Set the piece collection
     *
     * @param Collection $collection
     * @return void
     */
    public function set_collection(Collection $collection): void
    {
        $this->set_collection_id($collection->get_id());
        $this->setRelation('collection', $collection);
    }

    /**
     * Set the piece collection ID
     *
     * @param int $collection_id
     * @return void
     */
    public function set_collection_id(int $collection_id): void
    {
        $this->attributes['collection_id'] = $collection_id;
    }

    /**
     * Set the piece materials
     *
     * @param array $materials
     * @return void
     */
    public function set_materials(array $materials): void
    {
        $this->setRelation('materials', collect($materials));
    }

    /**
     * Set the piece order items
     *
     * @param array $order_items
     * @return void
     */
    public function set_order_items(array $order_items): void
    {
        $this->setRelation('order_items', collect($order_items));
    }

    /**
     * Get the collection associated with this piece
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo('App\\Models\\Collection');
    }

    /**
     * Get the materials associated with this piece
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany('App\\Models\\Material', 'material_piece', 'piece_id', 'material_id');
    }

    /**
     * Get the order items associated with this piece
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items(): HasMany
    {
        return $this->hasMany('App\\Models\\OrderItem');
    }
}
