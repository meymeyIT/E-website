<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->orderBy('id', 'desc')->paginate(100);

        return view('admin.categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/category/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('status', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/category/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('status', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category Deleted Successfully');
    }
    public function show(Category $category)
{
    return view('admin.categories.show', compact('category'));
}

}
