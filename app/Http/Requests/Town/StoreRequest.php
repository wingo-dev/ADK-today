<?php

namespace App\Http\Requests\Town;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
    public function rules(Request $request): array
    {
        return [
            // 'name'  => 'required|string|unique:towns,name',
            'name'  => [
                'required',
                'string',
                Rule::unique('towns')->where(function ($query) use($request) {
                    if (isset($request->is_more_country)) {
                        return $query->where('name', $request->name)->where('county_id', $request->county_id);
                    } else {
                        return $query->where('name', $request->name);
                    }
                }),
            ],
            'county_id' => 'required|exists:counties,id',
            'is_more_country' => 'boolean'
        ];
    }
}
