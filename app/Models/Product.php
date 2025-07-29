<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'price',
        'discount',
        'rating',
        'description',
        'stars',
        'slug',
        'is_active',
        'thumbnail'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCountStock(){
        // check table stock dengan product_id lalu sum (in-out) maka mendapatkan jumlah stock saat ini
        return $this->hasMany(Stock::class)->sum('in') - $this->hasMany(Stock::class)->sum('out');
    }
      
}
