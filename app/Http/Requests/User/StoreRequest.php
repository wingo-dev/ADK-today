<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidRecaptcha;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string',
            'password'              => 'sometimes',
            'email'                 => 'required|email|unique:users,email',
            'role'                  => 'required|integer',
            'title'                 => 'nullable',
            'organization'          => 'nullable',
            'phone'                 => 'nullable',//regex:/(01)[0-9]{9}/',
            'address1'              => 'nullable',
            'address2'              => 'nullable',
            'url'                   => 'nullable',
            'town'                  => 'nullable',
            'county'                => 'nullable',
            'state'                 => 'nullable',
            'zip'                   => 'nullable',
            // 'g-recaptcha-response'  => ['required', new ValidRecaptcha]
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please complete the captcha',
        ];
    }
}
