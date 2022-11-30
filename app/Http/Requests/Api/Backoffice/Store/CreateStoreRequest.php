<?php

namespace App\Http\Requests\Api\Backoffice\Store;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'take_out' => 'required|numeric|in:0,1',
            'delivery' => 'required|numeric|in:0,1',
            'rating' => 'required|numeric',
        ];
    }
}
