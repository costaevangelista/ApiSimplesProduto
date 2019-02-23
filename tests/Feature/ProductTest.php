<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApiList()
    {
        $products = factory(\App\Models\Product::class, 20)->create();

        $response = $this->json('GET', '/api/v1/products');
        $response->assertStatus(200);
    }

    public function testApiCreate()
    {
        $response = $this->json('POST', '/api/v1/products', ['name' => 'Produto de Teste', 'sku' => 'ASD', 'description' => 'Teste teste teste ... teste']);
        $response->assertStatus(201);
    }

    public function testApiUpdate()
    {
        $product = factory(\App\Models\Product::class, 1)->create();
        $response = $this->json('PUT', '/api/v1/products/'.$product[0]->id, ['name' => 'Produto de Teste Update', 'sku' => 'ASSD', 'description' => 'Teste teste teste UPDDATE']);
        $response->assertStatus(201);
    }

    public function testApiDelete()
    {
        $product = factory(\App\Models\Product::class, 1)->create();
        $response = $this->json('DELETE', '/api/v1/products/'.$product[0]->id);
        $response->assertStatus(200);
    }
}
