<?php

namespace App\Http\Resources;

use App\Models\ProductVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceStockResource extends JsonResource
{
    public $collects = ProductVariant::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'price' => $this->price ?? 0,
            'stock' => $this->stock ?? 0
        ];
    }
}
