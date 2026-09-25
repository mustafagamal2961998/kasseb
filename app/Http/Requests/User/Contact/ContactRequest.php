<?php

namespace App\Http\Requests\User\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'=>Auth::guard('sanctum')->id(),
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
            'title'=>['required','string'],
            'mobile'=>['required','string'],
            'email'=>['nullable','string'],
            'content'=>['required','string'],
        ];
    }
}
