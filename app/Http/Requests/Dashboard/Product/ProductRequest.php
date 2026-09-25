<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     
     protected function prepareForValidation()
     {
        
         $this->merge([
             'slug'=>Str::slug($this->name),
            //  'slug_en'=>Str::slug($this->name_en,'-','en'),
         ]);
     }

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
            
            'description'=>['nullable','string'],
            // 'description_en'=>['nullable','string'],
            
            'category_id'=>['required','exists:categories,id'],
            'brand_id'=>['nullable','exists:brands,id'],

            'images.*' => ['nullable', 'image'],
            
            'unit_price'=>['required','numeric'],
            'box_price'=>['nullable','numeric'],

            'discount_rate'=>['nullable','numeric'],

            'unit_stock'=>['required','numeric'],
            'box_stock'=>['nullable','numeric'],

            'minimum_stock'=>['required','integer'],
            'maximum_order'=>['nullable','integer'],
            
            // 'package_type'=>['required','in:one_unit,package'],
            'best_seller'=>['nullable','in:1'],
            'status'=>['required','in:active,archived']
        ];
    }
   
            
    // public function withValidator($validator)
    // {
    //     $validator->sometimes('images.0', 'required', function ($input) {
    //         return !$this->route('product'); // Adjust this based on your route parameter
    //     });
    // }
    

}
