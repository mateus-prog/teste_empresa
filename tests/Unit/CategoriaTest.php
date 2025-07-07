<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_categoria()
    {
        $categoria = Categoria::factory()->create([
            'nome' => 'Categoria Teste'
        ]);

        $this->assertDatabaseHas('categorias', [
            'nome' => 'Categoria Teste'
        ]);
    }

    public function test_categoria_has_many_produtos()
    {
        $categoria = Categoria::factory()->create();
        $produtos = Produto::factory()->count(3)->create(['categoria_id' => $categoria->id]);

        $this->assertCount(3, $categoria->produtos);
        $this->assertInstanceOf(Produto::class, $categoria->produtos->first());
    }

    public function test_categoria_fillable_fields()
    {
        $categoria = new Categoria();
        $fillable = ['nome'];

        $this->assertEquals($fillable, $categoria->getFillable());
    }
} 