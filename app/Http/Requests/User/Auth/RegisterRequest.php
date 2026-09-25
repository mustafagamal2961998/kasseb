<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'phone'=>['required','string','unique:users,phone'],
            'password'=>['required','string'],
            'full_name'=>['required','string'],
            'market_name'=>['nullable','string'],
            'address'=>['nullable','string'],
            'lat'=>['nullable','string'],
            'lng'=>['nullable','string'],
            // 'mobile'=>['required','unique:profiles,mobile'],
            // 'address'=>['required','string'],
            // 'work_type'=>['nullable','in:super_market,restaurant,cafee,other'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message'=>$validator->errors()->first(),'statusCode'=>422]));
    }
}
