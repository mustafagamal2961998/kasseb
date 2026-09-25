<?php

namespace App\Http\Requests\Dashboard\Coupon;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    function generateUniqueCouponCode($length = 8)
    {
        do {
            // Generate a random code with uppercase letters and numbers
            $coupon = strtoupper(Str::random($length));
        } while (Coupon::where('coupon', $coupon)->exists());

        return $coupon;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'coupon'=>$this->generateUniqueCouponCode(),
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
            'discount_percentage'=>['required'],
            'start_date_time'=>['required','date'],
            'end_date_time'=>['required','date'],
        ];
    }
}
