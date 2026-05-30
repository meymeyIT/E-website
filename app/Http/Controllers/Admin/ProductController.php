<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductFormRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with(['category', 'brand'])
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('id', 'desc')
            ->paginate(100);

        return view('admin.products.index', compact('products', 'search'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(CreateProductFormRequest $request)
    {
        try {
            $data = $request->validated();

            $data['uuid'] = Str::uuid()->toString();
            $data['is_trending'] = $request->has('is_trending');
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/products/';
                $file->move(public_path($path), $filename);
                $data['image'] = $path . $filename;
            }

            Product::create($data);

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create product.');
        }
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $data = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
                'small_description' => 'nullable|string',
                'description' => 'nullable|string',
                'original_price' => 'required|numeric',
                'selling_price' => 'required|numeric',
                'quantity' => 'required|integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keyword' => 'nullable|string',
                'is_trending' => 'nullable|boolean',
                'is_active' => 'nullable|boolean',
                'image' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }

                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/products/';
                $file->move(public_path($path), $filename);
                $data['image'] = $path . $filename;
            }

            $data['is_trending'] = $request->has('is_trending');
            $data['is_active'] = $request->has('is_active');

            $product->update($data);

            return redirect()->route('admin.products.index')->with('info', 'Product updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->delete();

            return redirect()->route('admin.products.index')->with('warning', 'Product deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product.');
        }
    }
}
