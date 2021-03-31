<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass fillable field
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'price',
        'stock'
    ];

    /**
     * Attribute should hidden
     *
     * @var array
     */
    protected $hidden = [
        'product_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
