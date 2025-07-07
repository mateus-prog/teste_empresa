<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_produto_validation_rules()
    {
        // Teste com dados vazios
        $response = $this->post('/produtos', []);
        $response->assertSessionHasErrors(['nome', 'categoria_id', 'marca_id']);

        // Teste com categoria_id inválido
        $response = $this->post('/produtos', [
            'nome' => 'Produto Teste',
            'categoria_id' => 999,
            'marca_id' => 999,
        ]);
        $response->assertSessionHasErrors(['categoria_id', 'marca_id']);

        // Teste com nome muito longo
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();
        
        $response = $this->post('/produtos', [
            'nome' => str_repeat('a', 256), // Mais de 255 caracteres
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);
        
        $response->assertSessionHasErrors(['nome']);
    }

    public function test_categoria_validation_rules()
    {
        // Teste com dados vazios
        $response = $this->post('/categorias', []);
        $response->assertSessionHasErrors(['nome']);

        // Teste com nome muito longo
        $response = $this->post('/categorias', [
            'nome' => str_repeat('a', 256), // Mais de 255 caracteres
        ]);
        $response->assertSessionHasErrors(['nome']);

        // Teste com nome duplicado
        $categoria = Categoria::factory()->create(['nome' => 'Categoria Teste']);
        
        $response = $this->post('/categorias', [
            'nome' => 'Categoria Teste',
        ]);
        $response->assertSessionHasErrors(['nome']);
    }

    public function test_marca_validation_rules()
    {
        // Teste com dados vazios
        $response = $this->post('/marcas', []);
        $response->assertSessionHasErrors(['nome']);

        // Teste com nome muito longo
        $response = $this->post('/marcas', [
            'nome' => str_repeat('a', 256), // Mais de 255 caracteres
        ]);
        $response->assertSessionHasErrors(['nome']);

        // Teste com nome duplicado
        $marca = Marca::factory()->create(['nome' => 'Marca Teste']);
        
        $response = $this->post('/marcas', [
            'nome' => 'Marca Teste',
        ]);
        $response->assertSessionHasErrors(['nome']);
    }

    public function test_update_validation_rules()
    {
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();
        $produto = Produto::factory()->create();

        // Teste atualização de produto com dados inválidos
        $response = $this->put("/produtos/{$produto->id}", [
            'nome' => '',
            'categoria_id' => 999,
            'marca_id' => 999,
        ]);
        $response->assertSessionHasErrors(['nome', 'categoria_id', 'marca_id']);

        // Teste atualização de categoria com nome vazio
        $response = $this->put("/categorias/{$categoria->id}", [
            'nome' => '',
        ]);
        $response->assertSessionHasErrors(['nome']);

        // Teste atualização de marca com nome vazio
        $response = $this->put("/marcas/{$marca->id}", [
            'nome' => '',
        ]);
        $response->assertSessionHasErrors(['nome']);
    }
} 