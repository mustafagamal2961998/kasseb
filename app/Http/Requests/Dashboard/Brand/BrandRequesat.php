<?php

namespace App\Http\Requests\Dashboard\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequesat extends FormRequest
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
            'name'=>['required','string'],
            // 'name_en'=>['required','string'],
            'image'=>['image'],
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->sometimes('image', 'required', function ($input) {
            return !$this->route('brand'); // Adjust this based on your route parameter
        });
    }
}
