<?php
/*
 * Author: Jeremias Figueroa Garcia
 * File: Collection.php
 * Description: Collection model with getters/setters
 * Created: 2026-03-23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;

class Collection extends Model
{
    /**
     * COLLECTION ATTRIBUTES
     * $this->attributes['id'] - int - contains the collection primary key
     * $this->attributes['name'] - string - contains the collection name
     * $this->attributes['creation_date'] - date - contains the collection creation date
     * pieces - Piece[] - contains the collection pieces list
     */

    protected $fillable = ['name', 'creation_date'];

    protected $casts = [
        'creation_date' => 'date',
    ];

    /**
     * Get the collection ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get the collection name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Get the creation date
     *
     * @return string
     */
    public function get_creation_date(): string
    {
        return $this->attributes['creation_date']
            ? \Carbon\Carbon::parse($this->attributes['creation_date'])->toDateString()
            : '';
    }

    /**
     * Get the collection pieces
     *
     * @return array
     */
    public function get_pieces(): array
    {
        if (!$this->relationLoaded('pieces')) {
            return [];
        }

        $pieces = $this->getRelation('pieces');

        return $pieces instanceof SupportCollection ? $pieces->all() : [];
    }

    /**
     * Set the collection ID
     *
     * @param int $id
     * @return void
     */
    public function set_id(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    /**
     * Set the collection name
     *
     * @param string $name
     * @return void
     */
    public function set_name(string $name): void
    {
        $this->attributes['name'] = $name;
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
     * Set the collection pieces
     *
     * @param array $pieces
     * @return void
     */
    public function set_pieces(array $pieces): void
    {
        $this->setRelation('pieces', collect($pieces));
    }

    /**
     * Get all pieces for this collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pieces(): HasMany
    {
        return $this->hasMany('App\\Models\\Piece');
    }
}
