<?php

namespace Tests\Unit;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_produto()
    {
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();
        
        $produto = Produto::factory()->create([
            'nome' => 'Produto Teste',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        $this->assertDatabaseHas('produtos', [
            'nome' => 'Produto Teste',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);
    }

    public function test_produto_belongs_to_categoria()
    {
        $categoria = Categoria::factory()->create();
        $produto = Produto::factory()->create(['categoria_id' => $categoria->id]);

        $this->assertInstanceOf(Categoria::class, $produto->categoria);
        $this->assertEquals($categoria->id, $produto->categoria->id);
    }

    public function test_produto_belongs_to_marca()
    {
        $marca = Marca::factory()->create();
        $produto = Produto::factory()->create(['marca_id' => $marca->id]);

        $this->assertInstanceOf(Marca::class, $produto->marca);
        $this->assertEquals($marca->id, $produto->marca->id);
    }

    public function test_produto_fillable_fields()
    {
        $produto = new Produto();
        $fillable = ['nome', 'categoria_id', 'marca_id'];

        $this->assertEquals($fillable, $produto->getFillable());
    }
} 