<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\SystemAlert;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register application services if needed
    }

    public function boot()
    {
        // Share categories and cart count globally for frontend layout
        View::composer('layouts.frontend', function ($view) {
            $headerCategories = Category::where('status', 1)->get();

            $cart = session()->get('cart', []);

            $cartCount = 0;
            if (is_array($cart) && !empty($cart)) {
                $cartCount = array_sum(array_column($cart, 'quantity'));
            }

            $view->with(compact('headerCategories', 'cartCount'));
        });

        // Share system alerts count globally for admin layout and all admin partials
        View::composer(['layouts.admin', 'layouts.partials.admin.*'], function ($view) {
            $systemAlerts = SystemAlert::where('is_read', false)->count();
            $view->with('systemAlerts', $systemAlerts);
        });
        
    }
}
