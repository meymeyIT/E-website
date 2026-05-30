<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category; // add this import
use App\Models\AboutUs;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch latest active products (e.g., 8 per page)
        $products = Product::where('is_active', 1)
                           ->latest()
                           ->paginate(100);

        // Fetch active categories
        $categories = Category::where('status', 1)->get();

        // Fetch the About Us content (first record)
        $about = AboutUs::first();

        // Pass variables to the view
        return view('frontend.home', compact('products', 'about', 'categories'));
    }
}
