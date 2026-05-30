<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'uuid',
        'name',
        'image',
        'is_active',
    ];

    // Automatically set UUID when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->uuid)) {
                $brand->uuid = (string) Str::uuid();
            }
        });
    }
}
