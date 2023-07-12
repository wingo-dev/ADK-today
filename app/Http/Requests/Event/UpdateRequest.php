<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'vendor_id'         => 'sometimes|exists:users,id',
            'title'             => [
                'sometimes',
                Rule::unique('events')->where('title', $this->title)->where('start_date', $this->start_date)->ignore($this->event),
            ],
            'long_description'  => 'sometimes',
            'short_description' => 'sometimes',
            'thumbnail'         => 'sometimes|file',
            'thumbnail_name'    => 'nullable',
            'image'             => 'sometimes|file',
            'image_name'        => 'nullable',
            'start_date'        => 'sometimes|date_format:Y-m-d',
            'start_time'        => 'sometimes',
            'end_date'          => 'sometimes|date_format:Y-m-d|after_or_equal:start_date',
            'end_time'          => 'sometimes',
            'event_url'         => 'nullable',
            'address'           => 'sometimes',
            'coordinates'       => 'nullable',
            'county_id'         => 'sometimes|exists:counties,id',
            'town_id'           => 'sometimes|exists:towns,id',
            'is_free'           => 'sometimes|boolean',
            'tags'              => 'required|array',
            'category_id'       => 'sometimes|exists:categories,id',
        ];
    }
}
