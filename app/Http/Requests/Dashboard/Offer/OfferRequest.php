<?php

namespace App\Http\Requests\Dashboard\Offer;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class OfferRequest extends FormRequest
{
    public $product;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * تجهيز البيانات قبل الـ validation فقط
     */
    protected function prepareForValidation()
    {
        $product = Product::findOrFail($this->product_id);
        $this->product = $product;

        $this->merge([
            'base_unit_price' => $product->unit_price,
            'base_box_price' => $product->box_price,
            'start_offer_date' => Carbon::parse($this->start_offer_date)->format('Y-m-d'),
            'end_offer_date'   => Carbon::parse($this->end_offer_date)->format('Y-m-d'),
        ]);
    }

    /**
     * قواعد التحقق
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],

            'base_unit_price' => ['required', 'numeric'],
            'base_box_price' => ['nullable', 'numeric'],

            'description' => ['nullable', 'string'],
            // 'description_en' => ['nullable', 'string'],

            'offer_unit_price' => [
                'required',
                'numeric',
                'lte:' . $this->product->unit_price,
            ],
            'offer_box_price' => [
                'nullable',
                'numeric',
                'lte:' . $this->product->box_price,
            ],

            'start_offer_date' => ['required', 'date'],
            'end_offer_date'   => ['required', 'date', 'after:start_offer_date'],
            'maximum'=>['nullable'],
            'status' => ['required', 'in:active,archived'],
        ];
    }   


    /**
     * رسائل الخطأ (اختياري بس مستحسن)
     */
    public function messages(): array
    {
        return [
            'offer_unit_price.lt' => 'سعر العرض يجب أن يكون أقل من سعر العبوة الحالي للمنتج',
            'offer_box_price.lt' => 'سعر العرض يجب أن يكون أقل من سعر الكرتونة الحالي للمنتج',
            'end_offer_date.after' => 'تاريخ نهاية العرض يجب أن يكون بعد تاريخ البداية',
        ];
    }
}
