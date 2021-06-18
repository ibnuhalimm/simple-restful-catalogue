<?php

namespace App\Repositories\ProductVariant;

use App\Models\ProductVariant;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository implements ProductVariantInterface
{
    /**
     * Inject Product Model
     *
     * @param \App\Models\ProductVariant $product
     * @return void
     */
    public function __construct(ProductVariant $product)
    {
        parent::__construct($product);
    }
}