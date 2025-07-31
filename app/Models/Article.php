<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     use HasFactory;
    protected $table = "articles";
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'featured_image', 
        'is_published', 'published_at', 'meta_description', 
        'meta_keywords', 'meta_title', 'category_id', 'user_id', 'tags'
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryArticle::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Scope untuk artikel yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    // Method untuk menambah view
    public function incrementViews()
    {
        $this->views()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer')
        ]);
    }

    // Accessor untuk tags
    public function getTagsListAttribute()
    {
        return $this->tags ? implode(', ', $this->tags) : '';
    }
}
