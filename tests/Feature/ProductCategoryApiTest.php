<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
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
        $response = $this->get('api/product-categories?page=1', $this->api_headers);

        $response->assertStatus(200)
            ->assertJsonStructure();
    }


    public function test_can_not_retrieve_product_categories_without_page_params()
    {
        $response = $this->get('api/product-categories', $this->api_headers);

        $response->assertStatus(422);
    }


    public function test_can_create_product_categories()
    {
        $body = [
            'name' => Str::random(10)
        ];

        $response = $this->post('api/product-categories', $body, $this->api_headers);

        $response->assertStatus(200);
    }


    public function test_failed_create_product_categories_if_name_less_than_three_chars()
    {
        $body = [
            'name' => Str::random(2)
        ];

        $response = $this->post('api/product-categories', $body, $this->api_headers);

        $response->assertStatus(422);
    }


    public function test_failed_create_product_categories_if_name_more_than_fifty_chars()
    {
        $body = [
            'name' => Str::random(51)
        ];

        $response = $this->post('api/product-categories', $body, $this->api_headers);

        $response->assertStatus(422);
    }


    public function test_can_get_single_product_category()
    {
        $repo = new ProductCategoryRepository();
        $product_factory = $repo->storeData(['name' => Str::random(10)]);

        $response = $this->get('api/product-categories/' . $product_factory->id, $this->api_headers);

        $response->assertStatus(200);
    }


    public function test_return_not_found_if_product_category_does_not_exists()
    {
        $response = $this->get('api/product-categories/100', $this->api_headers);

        $response->assertStatus(404);
    }
}
