<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UpdateProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'uuid' => ['required', 'string', 'max:255', "unique:products,uuid,$productId"],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', "unique:products,slug,$productId"],
            'small_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'original_price' => ['required', 'integer', 'min:0'],
            'selling_price' => ['required', 'integer', 'min:0', 'lte:original_price'],
            'image' => ['nullable', 'image', 'max:2048'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keyword' => ['nullable', 'string'],
            'is_trending' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?? Str::slug($this->name),
            'is_trending' => $this->is_trending ? 1 : 0,
            'is_active' => $this->is_active ?? 1,
            'quantity' => $this->quantity ?? 0,
        ]);
    }
}
