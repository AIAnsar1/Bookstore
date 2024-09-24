<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'description' => ['required', 'array'],
            'photo' => ['required', 'array'],
            'pdf' => ['required'],
            'selling_method' => ['required', 'boolean'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'brand_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'author_id' => ['required', 'numeric'],
            'genre_id' => ['required', 'numeric'],
        ];
    }
}
