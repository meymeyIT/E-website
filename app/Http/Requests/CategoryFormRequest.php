<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryFormRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'uuid'=>['Required'],
            'name'=>['Required'],
            'slug'=>['Required'],
            'description'=>['Required'],
            'status'=>['Required'],
            'popular'=>['Required'],
            'image'=>['nullable'],
            'meta_title'=>['Required'],
            'meta_description'=>['Required'],
            'meta_keyword'=>['Required'],
        ];
    }
    protected function prepareForValidation(): void
{
    $this->merge([
        'uuid' => Str::uuid(),
        'slug' => Str::slug($this->name),
        'popular'=> $this->popular == true? 1:0,
    ]);
    
  }
}