<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $user = request()->user;
        return [
            'name'                  => 'required|string',
            'email'                 => 'required|email|unique:users,email,'.$user,
            'password'              => 'sometimes',
            'role'                  => 'sometimes|integer',
            'title'                 => 'nullable',
            'organization'          => 'nullable',
            'phone'                 => 'nullable',//regex:/(01)[0-9]{9}/
            'address1'              => 'nullable',
            'address2'              => 'nullable',
            'url'                   => 'nullable',
            'town'                  => 'nullable',
            'county'                => 'nullable',
            'state'                 => 'nullable',
            'zip'                   => 'nullable',
            'status'                => 'nullable|integer',
            'is_verified'           => 'nullable'
        ];
    }
}
