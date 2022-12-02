<?php

namespace App\Http\Requests\Api\Backoffice\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required',

            'price_with_discount' => 'required|numeric|lte:price_without_discount',
            'price_without_discount' => 'required|numeric',

            'stock' => 'required|numeric',

            'product_categories' => 'array',

            'product_categories.*.id' => 'sometimes',
            'product_categories.*.category_id' => 'required',
        ];
    }
}
