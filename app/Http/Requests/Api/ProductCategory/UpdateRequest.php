<?php

namespace App\Http\Requests\Api\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'id' => [ 'required', 'integer' ],
            'name' => [ 'required', 'string', 'min:3', 'max:50', 'unique:'. (new ProductCategory())->getTable() .',name,' . $request->id ]
        ];
    }
}
