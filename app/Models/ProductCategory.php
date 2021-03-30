<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Disabled timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Mass fillable field
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Hide some attributes
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];
}
