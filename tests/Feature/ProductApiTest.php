<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_product_detail()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('api.products.show', [ 'product' => $product->id ]), $this->api_headers);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_not_view_product_detail_if_not_exists()
    {
        $response = $this->get(route('api.products.show', [ 'product' => 999 ]), $this->api_headers);
        $response->assertStatus(404);
    }
}
