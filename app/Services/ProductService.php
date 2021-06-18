<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use App\Repositories\ProductVariant\ProductVariantRepository;

class ProductService
{
    private $productRepo;
    private $variantRepo;

    public function __construct(
        ProductInterface $productRepo,
        ProductVariantRepository $variantRepo
    )
    {
        $this->productRepo = $productRepo;
        $this->variantRepo = $variantRepo;
    }

    /**
     * Find by id
     *
     * @param  int  $id
     * @return Collection
     */
    public function findByIdWithPriceStock(int $id)
    {
        return ProductResource::make($this->productRepo->findByIdWithPriceStock($id));
    }

    /**
     * Store new data
     *
     * @param  array  $attributes
     * @return array|bool
     */
    public function storeProduct(array $attributes)
    {
        try {
            $productData['product_category_id'] = $attributes['category_id'] ?? 0;
            $productData['name'] = $attributes['name'] ?? '';
            $productData['description'] = $attributes['description'] ?? '';
            $productData['weight_gram'] = $attributes['weight'] ?? 0;
            $productData['is_new'] = $attributes['is_new'] ?? 0;
            $productData['flag_variant'] = $attributes['flag_variant'] ?? Product::FLAG_VARIANT_AS_PRODUCT;
            $product = $this->productRepo->create($productData);

            $variantData['product_id'] = $product->id;
            $variantData['name'] = $product->name;
            $variantData['price'] = $attributes['price'] ?? 0;
            $variantData['stock'] = $attributes['stock'] ?? 0;
            $this->variantRepo->create($variantData);

            return [
                'product' => ProductResource::make($this->productRepo->findByIdWithPriceStock($product->id))
            ];

        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }

    /**
     * Update product data
     *
     * @param  int  $productId
     * @param  array  $attributes
     * @return mixed|bool
     */
    public function updateById(int $productId, array $attributes)
    {
        try {
            $productData['product_category_id'] = $attributes['category_id'] ?? 0;
            $productData['name'] = $attributes['name'] ?? '';
            $productData['description'] = $attributes['description'] ?? '';
            $productData['weight_gram'] = $attributes['weight'] ?? 0;
            $productData['is_new'] = $attributes['is_new'] ?? 0;
            $productData['flag_variant'] = $attributes['flag_variant'] ?? Product::FLAG_VARIANT_AS_PRODUCT;

            $product = $this->productRepo->findById($productId);
            $product->update($productData);


            $variantData['product_id'] = $product->id;
            $variantData['name'] = $product->name;
            $variantData['price'] = $attributes['price'] ?? 0;
            $variantData['stock'] = $attributes['stock'] ?? 0;

            $productVariant = $this->variantRepo->findByCriteria([ 'product_id' => $productId ]);
            $productVariant->update($variantData);

            return [
                'product' => ProductResource::make($this->productRepo->findByIdWithPriceStock($product->id))
            ];

        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }
}