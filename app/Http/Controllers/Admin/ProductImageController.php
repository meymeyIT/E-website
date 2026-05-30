<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    // Show all images for a product
    public function index(Product $product)
    {
        $product->load('images');
        return view('admin.products.images.index', compact('product'));
    }

    // Show form to upload new image for product
    public function create(Product $product)
    {
        return view('admin.products.images.create', compact('product'));
    }

    // Store new product image
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        foreach ($request->file('images') as $imageFile) {
            $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $path = 'uploads/product_images/';
            $imageFile->move(public_path($path), $filename);
    
            $product->images()->create([
                'image' => $filename,
                // other fields if any
            ]);
        }
    
        return redirect()->route('admin.products.images.index', $product->slug)
                         ->with('success', 'Images uploaded successfully.');
    }
    
    // Delete a product image
    public function destroy(Product $product, ProductImage $image)
    {
        if ($image->image && file_exists(public_path('uploads/product_images/' . $image->image))) {
            unlink(public_path('uploads/product_images/' . $image->image));
        }

        $image->delete();

        return redirect()->route('admin.products.images.index', $product->slug)
                         ->with('success', 'Product image deleted successfully.');
    }
}
