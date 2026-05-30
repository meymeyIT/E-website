<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Show active products on the homepage.
     */
    public function index()
    {
        // Load active products with relationships (optional)
        $products = Product::with(['brand', 'category', 'images'])
            ->where('is_active', 1)
            ->latest()
            ->paginate(100);

        return view('frontend.products.index', compact('products'));
    }

    /**
     * Show a specific product by slug.
     */
    public function show($slug)
    {
        $product = Product::with(['brand', 'category', 'images'])
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        return view('frontend.products.show', compact('product'));
    }
}
