<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'is_active',
    ];
    
    // Relationship: one category has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
