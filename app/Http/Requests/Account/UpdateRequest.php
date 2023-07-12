<?php

namespace App\Http\Requests\Account;

use App\Utils\Common\UserRoles;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user();
        if ($user->role == UserRoles::VENDOR) {
            return [
                'name'                  => 'somtimes|string',
                'email'                 => 'sometimes|email|unique:users,email,'.$user->id,
                'password'              => 'sometimes',
                'title'                 => 'required',
                'organization'          => 'required',
                'phone'                 => 'required',//regex:/(01)[0-9]{9}/',
                'address1'              => 'required',
                'address2'              => 'nullable',
                'url'                   => 'nullable',
                'town'                  => 'required',
                'county'                => 'required',
                'state'                 => 'required',
                'zip'                   => 'required',
            ];
        }
        return [
            'name'                  => 'sometimes|string',
            'email'                 => 'sometimes|email|unique:users,email,'.$user->id,
            'password'              => 'sometimes',
        ];
    }
}
