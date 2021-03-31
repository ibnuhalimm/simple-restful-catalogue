<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_product_detail()
    {
        $product_repo = new ProductRepository;

        $product = $product_repo->storeData([
            'product_category_id' => $this->faker->randomDigitNotZero(),
            'name' => $this->faker->text(5),
            'description' => $this->faker->text(),
            'is_new' => $this->faker->boolean(),
            'weight_gram' => $this->faker->randomFloat(),
            'flag_variant' => $this->faker->randomElement([ Product::FLAG_VARIANT_AS_PRODUCT, Product::FLAG_VARIANT_AS_VARIANT ])
        ]);

        $response = $this->get('/api/products/' . $product->id, $this->api_headers);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_not_view_product_detail_if_not_exists()
    {
        $response = $this->get('/api/products/100', $this->api_headers);

        $response->assertStatus(404);
    }
}
