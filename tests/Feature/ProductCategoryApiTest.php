<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductCategoryApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrieve_product_categories()
    {
        $response = $this->get(route('api.product-categories.index'), $this->api_headers);

        $response->assertStatus(200)
            ->assertJsonStructure();
    }


    public function test_can_create_product_categories()
    {
        $body = [
            'name' => Str::random(10)
        ];

        $response = $this->post(route('api.product-categories.store'), $body, $this->api_headers);
        $response->assertStatus(201);
    }


    public function test_failed_create_product_categories_if_name_less_than_three_chars()
    {
        $body = [
            'name' => Str::random(2)
        ];

        $response = $this->post(route('api.product-categories.store'), $body, $this->api_headers);
        $response->assertStatus(422);
    }


    public function test_failed_create_product_categories_if_name_more_than_fifty_chars()
    {
        $body = [
            'name' => Str::random(51)
        ];

        $response = $this->post(route('api.product-categories.store'), $body, $this->api_headers);
        $response->assertStatus(422);
    }


    public function test_can_get_single_product_category()
    {
        $product_category = ProductCategory::factory()->create();

        $response = $this->get(route('api.product-categories.show', [ 'product_category' => $product_category->id ]), $this->api_headers);
        $response->assertStatus(200);
    }


    public function test_return_not_found_if_product_category_does_not_exists()
    {
        $response = $this->get(route('api.product-categories.show', [ 'product_category' => 999 ]), $this->api_headers);
        $response->assertStatus(404);
    }
}
