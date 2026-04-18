<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'cc' => ['required', 'integer', 'min:100', 'max:10000'],
            'capacity' => ['required', 'integer', 'min:1', 'max:20'],
            'transmission' => ['required', 'in:manual,automatic'],
            'price_12h' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'price_24h' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'status' => ['required', 'in:available,rented,maintenance'],
            'description' => ['nullable', 'string', 'max:1000'],
            'thumbnail' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
        ];
    }
}
