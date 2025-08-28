<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
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
        'thumbnail',
        'tokopedia',
        'shopee',
        'lazada',
        'keyword'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class,  'product_id','id');
    }

    public function stocks (){
        return $this->hasMany(Stock::class, 'product_id','id');
    }
      
}
