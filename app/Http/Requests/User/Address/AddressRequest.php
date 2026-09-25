<?php

namespace App\Http\Requests\User\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'=>Auth::guard('sanctum')->id(),
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
            'address'=>['required','string'],
            // 'first_name'=>['required','string'],
            // 'last_name'=>['required','string'],
            // 'mobile'=>['required','string'],
            // 'other_mobile'=>['nullable','string'],
            // 'country_code'=>['required','max:4'],
            // 'city'=>['required','string'],
            // 'street'=>['required','string'],
            // 'build'=>['required','string'],
            // 'floor'=>['required','string'],
            // 'apartment'=>['required','string'],
            'status'=>['required','in:active,archived'],
        ];
    }
}
