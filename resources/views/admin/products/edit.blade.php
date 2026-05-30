@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <h4 class="mb-0">Edit Product</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm">Back</a>
    </div>

    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger p-2">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $cat->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Brand</label>
                    <select name="brand_id" class="form-select" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @foreach (['name', 'slug'] as $field)
                <div class="col-md-6">
                    <label class="form-label text-capitalize">{{ $field }}</label>
                    <input type="text" name="{{ $field }}" value="{{ old($field, $product->$field) }}" class="form-control" required>
                </div>
                @endforeach

                <div class="col-12">
                    <label>Short Description</label>
                    <textarea name="small_description" class="form-control" rows="2">{{ old('small_description', $product->small_description) }}</textarea>
                </div>

                <div class="col-12">
                    <label>Full Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                @foreach ([
                    ['label' => 'Original Price', 'name' => 'original_price', 'step' => '0.01'],
                    ['label' => 'Selling Price', 'name' => 'selling_price', 'step' => '0.01'],
                    ['label' => 'Quantity', 'name' => 'quantity', 'step' => '1'],
                ] as $num)
                <div class="col-md-4">
                    <label>{{ $num['label'] }}</label>
                    <input type="number" name="{{ $num['name'] }}" value="{{ old($num['name'], $product->{$num['name']}) }}" step="{{ $num['step'] }}" min="0" class="form-control" required>
                </div>
                @endforeach

                @foreach (['meta_title', 'meta_description', 'meta_keyword'] as $meta)
                <div class="col-md-{{ $meta === 'meta_title' ? '12' : '6' }}">
                    <label class="text-capitalize">{{ str_replace('_', ' ', $meta) }}</label>
                    <input type="text" name="{{ $meta }}" value="{{ old($meta, $product->$meta) }}" class="form-control">
                </div>
                @endforeach

                <div class="col-md-6 d-flex gap-3 align-items-center">
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-check mb-0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>

                    <input type="hidden" name="is_trending" value="0">
                    <div class="form-check mb-0">
                        <input type="checkbox" id="is_trending" name="is_trending" value="1" class="form-check-input" {{ old('is_trending', $product->is_trending) ? 'checked' : '' }}>
                        <label for="is_trending" class="form-check-label">Trending</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" alt="Current Image" class="mt-2 rounded border" style="max-width:120px;">
                    @endif
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
