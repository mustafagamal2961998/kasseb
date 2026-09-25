<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    
    protected function prepareForValidation()
    {
        if($this->delivery_status){
            $delivery_status='1';
        } else{
            $delivery_status='0';
        }
        $this->merge([
            'delivery_status'=>$delivery_status,
        ]);
    }
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
            'website_name_ar'=>['required','string'],
            'website_name_en'=>['required','string'],
            'website_bio_ar'=>['required','string'],
            'website_bio_en'=>['required','string'],
            'logo'=>['nullable','mimes:png,jpg,jpeg'],
            'refund_day'=>['required','integer'],
            'minimum_order_price'=>['required','integer'],
            'shipping_amount'=>['required','integer'],
            // 'main_bg_color'=>['required','string'],
            // 'main_color_text'=>['required','string'],
            // 'main_bg_color_on_hover'=>['required','string'],
            // 'main_color_text_on_hover'=>['required','string'],
            // 'main_link_color_text'=>['required','string'],
            // 'main_link_color_text_on_hover'=>['required','string'],
            // 'delivery_status'=>['required','in:0,1']
        ];

    }
}
