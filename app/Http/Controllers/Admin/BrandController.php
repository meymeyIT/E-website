<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // List all brands with optional search and pagination
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Brand::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $brands = $query->orderBy('id', 'desc')->paginate(100); // paginate 10 per page

        return view('admin.brands.index', compact('brands'));
    }

    // Show create form
    public function create()
    {
        return view('admin.brands.create');
    }

    // Store new brand
    public function store(BrandFormRequest $request)
    {
        $data = $request->validated();

        // Generate UUID
        $data['uuid'] = Str::uuid()->toString();

        // Checkbox handling: if not checked, set 0
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/brands/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        Brand::create($data);

        return redirect('/admin/brands')->with('status', 'Brand Created Successfully');
    }

    // Show single brand details
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    // Show edit form
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    // Update brand
    public function update(BrandFormRequest $request, Brand $brand)
    {
        $data = $request->validated();

        // Checkbox handling: if not checked, set 0
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Handle image upload & delete old image if exists
        if ($request->hasFile('image')) {
            if ($brand->image && file_exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/brands/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        $brand->update($data);

        return redirect('/admin/brands')->with('status', 'Brand Updated Successfully');
    }

    // Delete brand
    public function destroy(Brand $brand)
    {
        if ($brand->image && file_exists(public_path($brand->image))) {
            unlink(public_path($brand->image));
        }

        $brand->delete();

        return redirect('/admin/brands')->with('status', 'Brand Deleted Successfully');
    }
}
