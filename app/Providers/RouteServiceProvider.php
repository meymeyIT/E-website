<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        Route::bind('product', function ($value) {
            if (request()->is('admin/products/*') || request()->is('admin/products')) {
                return Product::where('id', $value)->firstOrFail();
            }
            return Product::where('slug', $value)->firstOrFail();
        });
    }

    // ... other methods (map, etc.) remain unchanged
}
