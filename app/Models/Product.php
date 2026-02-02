<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'pet_type',
        'category',
        'brand',
        'image',
        'stock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    /**
     * Scope a query to only include available products.
     */
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope a query to search by name.
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where('name', 'like', '%' . $term . '%');
        }
        return $query;
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Get the product's status label.
     */
    protected function statusLabel(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function (mixed $value, array $attributes) {
                if ($attributes['stock'] <= 0) {
                    return 'Sold Out';
                } elseif ($attributes['stock'] < 10) {
                    return 'Low Stock';
                }
                return 'In Stock';
            },
        );
    }
}
