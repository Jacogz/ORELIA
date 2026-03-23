<?php
/*
 * Author: Isabella Hernandez Posada
 * File: Material.php
 * Description: Material model with getters/setters
 * Created: 2025-03-22
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * MATERIAL ATTRIBUTES
     * $this->attributes['id'] - int - contains the material primary key
     * $this->attributes['name'] - string - contains the material name
     * $this->attributes['type'] - string - contains the material type
     * $this->attributes['description'] - string - contains the material description
     * $this->attributes['color'] - string - contains the material color
     * $this->attributes['created_at'] - datetime - contains the creation date
     * $this->attributes['updated_at'] - datetime - contains the update date
     */

    protected $fillable = ['name', 'type', 'description', 'color'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the material ID
     *
     * @return int
     */
    public function get_id(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get the material name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Get the material type
     *
     * @return string
     */
    public function get_type(): string
    {
        return $this->attributes['type'];
    }

    /**
     * Get the material description
     *
     * @return string
     */
    public function get_description(): string
    {
        return $this->attributes['description'];
    }

    /**
     * Get the material color
     *
     * @return string
     */
    public function get_color(): string
    {
        return $this->attributes['color'];
    }

    /**
     * Set the material name
     *
     * @param string $name
     * @return void
     */
    public function set_name(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * Set the material type
     *
     * @param string $type
     * @return void
     */
    public function set_type(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    /**
     * Set the material description
     *
     * @param string $description
     * @return void
     */
    public function set_description(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    /**
     * Set the material color
     *
     * @param string $color
     * @return void
     */
    public function set_color(string $color): void
    {
        $this->attributes['color'] = $color;
    }
}