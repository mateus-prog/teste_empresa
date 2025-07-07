<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_displays_categorias()
    {
        $response = $this->get('/categorias');

        $response->assertStatus(200);
        $response->assertViewIs('categorias.index');
        $response->assertViewHas('categorias');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/categorias/create');

        $response->assertStatus(200);
        $response->assertViewIs('categorias.create');
    }

    public function test_store_creates_categoria()
    {
        $response = $this->post('/categorias', [
            'nome' => 'Nova Categoria',
        ]);

        $response->assertRedirect('/categorias');
        $this->assertDatabaseHas('categorias', [
            'nome' => 'Nova Categoria',
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post('/categorias', []);

        $response->assertSessionHasErrors(['nome']);
    }

    public function test_show_displays_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get("/categorias/{$categoria->id}");

        $response->assertStatus(200);
        $response->assertViewIs('categorias.show');
        $response->assertViewHas('categoria', $categoria);
    }

    public function test_edit_displays_form()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get("/categorias/{$categoria->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('categorias.edit');
        $response->assertViewHas('categoria', $categoria);
    }

    public function test_update_modifies_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->put("/categorias/{$categoria->id}", [
            'nome' => 'Categoria Atualizada',
        ]);

        $response->assertRedirect('/categorias');
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nome' => 'Categoria Atualizada',
        ]);
    }

    public function test_destroy_deletes_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->delete("/categorias/{$categoria->id}");

        $response->assertRedirect('/categorias');
        $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);
    }
} 