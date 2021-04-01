<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasOne(ProductVariant::class, 'product_id', 'id')->withDefault();
    }

    /**
     * Inverse relationship to 'product_category'
     *
     * @return BelongsTo
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Relationship to `product_variants` table
     *
     * @return HasMany
     */
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
