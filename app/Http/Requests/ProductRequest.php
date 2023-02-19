<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name'          => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'unit'          => 'required|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'min_qty'       => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'unit_price'    => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount'      => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'current_stock' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    /**
     * Get the validation messages of rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Product name is required',
            'name.regex'                => 'Product name is invalid',
            'unit.required'             => 'Unit field is required',
            'unit.regex'                => 'Unit is invalid',
            'min_qty.required'          => 'Minimum purchase quantity is required',
            'min_qty.numeric'           => 'Minimum purchase must be numeric',
            'min_qty.regex'             => 'Quantity  is invalid',
            'unit_price.required'       => 'Unit price is required',
            'unit_price.numeric'        => 'Unit price must be numeric',
            'unit_price.regex'          => 'Unit price is invalid',
            'discount.numeric'          => 'Discount must be numeric',
            'discount.required'          =>'Minimum discount should be 0',
            'current_stock.required'    => 'Current stock is required',
            'current_stock.numeric'     => 'Current stock must be numeric',
        ];
    }
}
