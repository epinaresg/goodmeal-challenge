<?php

namespace App\Http\Requests\Api\Backoffice\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => 'required',
            'background' => 'required',
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'take_out' => 'required|numeric|in:0,1',
            'delivery' => 'required|numeric|in:0,1',
            'rating' => 'required|numeric',

            'schedules.take_out.id' => 'sometimes',
            'schedules.take_out.start_hour' => 'sometimes|date_format:H:i',
            'schedules.take_out.end_hour' => 'sometimes|date_format:H:i|after:schedules.take_out.start_hour',

            'schedules.delivery.id' => 'sometimes',
            'schedules.delivery.start_hour' => 'sometimes|date_format:H:i',
            'schedules.delivery.end_hour' => 'sometimes|date_format:H:i|after:schedules.delivery.start_hour',
        ];
    }
}
