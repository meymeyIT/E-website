<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        // Use 'status' instead of 'is_active'
        $categories = Category::where('status', 1)->get();
        return view('frontend.categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        // Assuming products table uses 'is_active'
        $products = $category->products()->where('is_active', 1)->paginate(8);

        return view('frontend.categories.show', compact('category', 'products'));
    }
}
