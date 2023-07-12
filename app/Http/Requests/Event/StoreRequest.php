<?php

namespace App\Http\Requests\Event;

use App\Utils\Common\UserRoles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'vendor_id'         => 'required|exists:users,id',
            'title'             => [
                'required',
                Rule::unique('events')->where('title', $this->title)->where('start_date', $this->start_date),
            ],
            'long_description'  => 'required',
            'short_description' => 'required',
            'thumbnail'         => 'required_without_all:thumbnail,thumbnail_name|file',
            'thumbnail_name'    => 'nullable',
            'image'             => 'required_without_all:image,image_name|file',
            'image_name'        => 'nullable',
            'start_date'        => 'required|date_format:Y-m-d',
            'start_time'        => 'required',
            'end_date'          => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'end_time'          => 'required',
            'address'           => 'required',
            'coordinates'       => 'nullable',
            'event_url'         => 'nullable',
            'county_id'         => 'required|exists:counties,id',
            'town_id'           => 'required|exists:towns,id',
            'is_free'           => 'nullable',
            'tags'              => 'required|array',
            'category_id'       => 'required|exists:categories,id',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.required_without_all' => 'The image field is required',
            'thumbnail.required_without_all' => 'The thumbnail field is required',
        ];
    }
}
