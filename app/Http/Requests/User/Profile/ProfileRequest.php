<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'phone'=>['required','string',Rule::unique('users','phone')->ignore(Auth::guard('sanctum')->id())],
            'full_name'=>['required','string'],
            'email'=>['nullable',Rule::unique('profiles','email')->ignore(Auth::guard('sanctum')->id(),'user_id')],
            'password'=>['required','string'],
        ];
    }
}
