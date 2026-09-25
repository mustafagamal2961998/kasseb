<?php

namespace App\Http\Requests\Dashboard\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'category_id'=>['nullable'],
            'description_ar'=>['required','string'],
            'description_en'=>['required','string'],
            'status'=>['required','in:active,archived'],
            'slider'=>['required','mimes:png,jpg,jpeg,gif']
        ];
    }
    public function withValidator($validator)
    {
        $validator->sometimes('slider', 'required', function ($input) {
            return !$this->route('slider'); // Adjust this based on your route parameter
        });
    }
}
