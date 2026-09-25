<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            // 'category_id'=>['nullable','exists:categories,id'],
            'name'=>['required','string'],
            // 'name_en'=>['required','string'],
            'description'=>['nullable','string'],
            // 'description_en'=>['nullable','string'],
            'bg_color' => ['required','string'],
            'image'=>['image'],
            'status'=>['required','in:active,archived']
        ];
    }
    public function withValidator($validator)
    {
        $validator->sometimes('image', 'required', function ($input) {
            return !$this->route('category'); // Adjust this based on your route parameter
        });
    }
}
