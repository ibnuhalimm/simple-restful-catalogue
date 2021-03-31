<?php

namespace App\Http\Requests\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => [ 'required', 'string', 'min:3', 'max:50', 'unique:' . (new ProductCategory())->getTable() .',name' ]
        ];
    }

    /**
     * Get validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique' => 'The :attributes has already exists.'
        ];
    }
}
