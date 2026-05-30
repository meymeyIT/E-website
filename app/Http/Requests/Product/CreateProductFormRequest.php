<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'name' => ['required'],
            'slug' => ['required'],
            'small_description' => ['required'],
            'description' => ['required'],
            'original_price' => ['required', 'integer', 'min:0'],
            'selling_price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable'],
            'quantity' => ['nullable'],  // If you want strict int validation, add integer|min:0
            'meta_title' => ['nullable'],
            'meta_description' => ['nullable'],
            'meta_keyword' => ['nullable'],
            'is_trending' => ['nullable'],
            'is_active' => ['nullable'],
        ];
    }

    /**
     * Prepare the data for validation.
     * Automatically generate uuid and slug from name.
     * Set boolean flags as 0 or 1.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'uuid' => $this->uuid ?? Str::uuid()->toString(),
            'slug' => $this->slug ?? Str::slug($this->name),
            'is_trending' => $this->is_trending ? 1 : 0,
            'is_active' => $this->is_active ?? 1,
            'quantity' => $this->quantity ?? '0',
        ]);
    }
}
