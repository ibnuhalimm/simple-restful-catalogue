<?php

namespace App\Http\Requests\Product;

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
        return [
            'category_id' => ['required', 'integer', 'min:1'],
            'name' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['required'],
            'is_new' => ['required'],
            'weight' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:5000'],
            'stock' => ['required', 'integer', 'min:1']
        ];
    }

    /**
     * Get validation field name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'category_id' => 'Kategori Produk',
            'name' => 'Nama Produk',
            'description' => 'Deskripsi',
            'is_new' => 'Kondisi',
            'weight' => 'Berat',
            'price' => 'Harga',
            'stock' => 'Stok'
        ];
    }
}
