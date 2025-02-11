<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_product()
    {
        $response = $this->postJson('/api/products', [
            'nome' => 'Produto Teste',
            'preco' => 100.50,
            'descricao' => 'Descrição do produto teste',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                 'data' => [
                     'nome' => 'Produto Teste',
                     'preco' => 100.50,
                     'descricao' => 'Descrição do produto teste',
                 ],
             ]);
    }

    public function test_update_product()
    {
        $product = \App\Models\Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'nome' => 'Produto Atualizado',
            'preco' => 200.75,
            'descricao' => 'Descrição atualizada',
        ]);

        $response->assertStatus(200) 
                 ->assertJson([
                 'data' => [
                     'nome' => 'Produto Atualizado',
                     'preco' => 200.75,
                     'descricao' => 'Descrição atualizada',
                 ],
             ]);
    }

    public function test_delete_product()
    {
        $product = \App\Models\Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204); 
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    public function test_validation_on_create()
    {
        $response = $this->postJson('/api/products', [
            'nome' => '', 
            'preco' => 'abc', 
        ]);

        $response->assertStatus(422) 
                 ->assertJsonValidationErrors(['nome', 'preco']);
    }
}
