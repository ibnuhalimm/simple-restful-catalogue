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
        'created_at',
        'updated_at'
    ];


    /**
     * Relationship to get price and stock
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function price_stock()
    {
        return $this->hasOne(ProductVariant::class, 'product_id', 'id');
    }
}
