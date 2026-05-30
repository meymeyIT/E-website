<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;  // <-- Add this import

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'reorder',
    ];

    // Relationship: ProductImage belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    
}
