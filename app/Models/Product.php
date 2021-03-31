<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Define flag_variant field
     *
     * @var mixed
     */
    CONST FLAG_VARIANT_AS_PRODUCT = 'P';
    CONST FLAG_VARIANT_AS_VARIANT = 'V';

    /**
     * Mass fillable field
     *
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'is_new',
        'weight_gram',
        'flag_variant'
    ];

    /**
     * Attribute should hidden
     *
     * @var hidden
     */
    protected $hidden = [
        'product_variant_id',
        'created_at',
        'updated_at'
    ];
}
