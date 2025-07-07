<?php

namespace Tests\Feature;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarcaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_displays_marcas()
    {
        $response = $this->get('/marcas');

        $response->assertStatus(200);
        $response->assertViewIs('marcas.index');
        $response->assertViewHas('marcas');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/marcas/create');

        $response->assertStatus(200);
        $response->assertViewIs('marcas.create');
    }

    public function test_store_creates_marca()
    {
        $response = $this->post('/marcas', [
            'nome' => 'Nova Marca',
        ]);

        $response->assertRedirect('/marcas');
        $this->assertDatabaseHas('marcas', [
            'nome' => 'Nova Marca',
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post('/marcas', []);

        $response->assertSessionHasErrors(['nome']);
    }

    public function test_show_displays_marca()
    {
        $marca = Marca::factory()->create();

        $response = $this->get("/marcas/{$marca->id}");

        $response->assertStatus(200);
        $response->assertViewIs('marcas.show');
        $response->assertViewHas('marca', $marca);
    }

    public function test_edit_displays_form()
    {
        $marca = Marca::factory()->create();

        $response = $this->get("/marcas/{$marca->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('marcas.edit');
        $response->assertViewHas('marca', $marca);
    }

    public function test_update_modifies_marca()
    {
        $marca = Marca::factory()->create();

        $response = $this->put("/marcas/{$marca->id}", [
            'nome' => 'Marca Atualizada',
        ]);

        $response->assertRedirect('/marcas');
        $this->assertDatabaseHas('marcas', [
            'id' => $marca->id,
            'nome' => 'Marca Atualizada',
        ]);
    }

    public function test_destroy_deletes_marca()
    {
        $marca = Marca::factory()->create();

        $response = $this->delete("/marcas/{$marca->id}");

        $response->assertRedirect('/marcas');
        $this->assertDatabaseMissing('marcas', ['id' => $marca->id]);
    }
} 