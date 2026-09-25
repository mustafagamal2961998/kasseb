<?php

namespace App\Http\Requests\User\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
class CartRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $user = Auth::guard('sanctum')->user();
        $product = Product::find($this->product_id);

        if ($product) {
            if($this->need_type=='unit'){

                $price = $product->unit_price * (1 - $product->discount_rate / 100);
            } else {
                $price = $product->box_price * (1 - $product->discount_rate / 100);
            }
            $quantity = $this->quantity ?? 1;

            $this->merge([
                'user_id'        => $user->id,
                'quantity'       => $quantity,
                'discount_rate'  => $product->discount_rate,
                'price'          => $price,
                'total'          => $price * $quantity,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1'],
            'need_type'  => ['required', 'in:unit,box'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->checkProductStock($validator);
        });
    }

    protected function checkProductStock($validator)
    {
        $product = Product::find($this->product_id);
        $quantity = $this->quantity ?? 1;
         if($this->need_type=='unit'){
            $stock = $product->unit_stock;
         }else{
            $stock = $product->box_stock;
         }
        
        if ($product && $quantity > $stock) {
            $validator->errors()->add(
                'product',
                'عفوا الكمية المطلوبة غير متوفرة'
            );
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->first(),
                'statusCode' => 422,
            ])
        );
    }

    public function authorize(): bool
    {
        return true;
    }
}
