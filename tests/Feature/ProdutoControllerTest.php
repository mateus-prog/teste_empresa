<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_displays_produtos()
    {
        $response = $this->get('/produtos');

        $response->assertStatus(200);
        $response->assertViewIs('produtos.index');
        $response->assertViewHas('produtos');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/produtos/create');

        $response->assertStatus(200);
        $response->assertViewIs('produtos.create');
        $response->assertViewHas('categorias');
        $response->assertViewHas('marcas');
    }

    public function test_store_creates_produto()
    {
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();

        $response = $this->post('/produtos', [
            'nome' => 'Novo Produto',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        $response->assertRedirect('/produtos');
        $this->assertDatabaseHas('produtos', [
            'nome' => 'Novo Produto',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post('/produtos', []);

        $response->assertSessionHasErrors(['nome', 'categoria_id', 'marca_id']);
    }

    public function test_show_displays_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->get("/produtos/{$produto->id}");

        $response->assertStatus(200);
        $response->assertViewIs('produtos.show');
        $response->assertViewHas('produto', $produto);
    }

    public function test_edit_displays_form()
    {
        $produto = Produto::factory()->create();

        $response = $this->get("/produtos/{$produto->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('produtos.edit');
        $response->assertViewHas('produto', $produto);
        $response->assertViewHas('categorias');
        $response->assertViewHas('marcas');
    }

    public function test_update_modifies_produto()
    {
        $produto = Produto::factory()->create();
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();

        $response = $this->put("/produtos/{$produto->id}", [
            'nome' => 'Produto Atualizado',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        $response->assertRedirect('/produtos');
        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
            'nome' => 'Produto Atualizado',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);
    }

    public function test_destroy_deletes_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->delete("/produtos/{$produto->id}");

        $response->assertRedirect('/produtos');
        $this->assertDatabaseMissing('produtos', ['id' => $produto->id]);
    }
} 