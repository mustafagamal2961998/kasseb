<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = request()->route('user');
        return [
            'avatar'=>['nullable','mimes:png,jpg,jpeg'],
            'phone'=>['required',Rule::unique('users','phone')->ignore($id)],
            'password'=>['required','string'],
            'balance'=>['required','numeric'],
            'full_name'=>['required','string'],
            'role'=>['required','in:user,deliver'],
            // 'mobile'=>['required',Rule::unique('profiles','mobile')->ignore($id,'user_id')],
            // 'address'=>['required','string'],
            // 'type'=>['required','in:user,trader'],
            // 'work_type'=>['required','in:super_market,restaurant,cafee,other'],
            'status'=>['required','in:active,blocked']
        ];
    }
}
