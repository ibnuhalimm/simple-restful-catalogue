<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private function hasVariant()
    {
        return $this->flag_variant === Product::FLAG_VARIANT_AS_VARIANT;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_new' => $this->is_new,
            'weight_gram' => $this->weight_gram,
            'price_stock' => PriceStockResource::make($this->whenLoaded('price_stock')),
            'variants' => $this->when($this->hasVariant(), ProductVariantResource::collection($this->whenLoaded('product_variants')))
        ];
    }
}
