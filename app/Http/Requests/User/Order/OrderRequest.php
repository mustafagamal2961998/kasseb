<?php

namespace App\Http\Requests\User\Order;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function prepareForValidation()
    {
      

        $user = Auth::guard('sanctum')->user();
        $this->merge([
            'user_id' => $user->id,
            // 'type'=>$user->type,
            // 'product_name_ar'=>'1',
            // 'product_name_en' => '3',
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
            'coupon'=>['nullable','exists:coupons,coupon'],
            'address_id'=>['required','exists:addresses,id'],
            'note'=>['nullable','string'],
            'date_of_receipt'=>['nullable','date'],
        ];
    }
}
