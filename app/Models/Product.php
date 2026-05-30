<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'category_id', 'brand_id', 'name', 'slug',
        'small_description', 'description',
        'original_price', 'selling_price', 'image', 'quantity',
        'meta_title', 'meta_description', 'meta_keyword',
        'is_trending', 'is_active',
    ];

    // Use slug for route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
