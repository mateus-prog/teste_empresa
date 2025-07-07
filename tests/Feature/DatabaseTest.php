<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_relationships()
    {
        // Criar dados
        $categoria = Categoria::factory()->create(['nome' => 'Eletrônicos']);
        $marca = Marca::factory()->create(['nome' => 'Samsung']);
        $produto = Produto::factory()->create([
            'nome' => 'Smartphone Galaxy',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        // Verificar relacionamentos
        $this->assertEquals($categoria->id, $produto->categoria->id);
        $this->assertEquals($marca->id, $produto->marca->id);
        $this->assertEquals('Eletrônicos', $produto->categoria->nome);
        $this->assertEquals('Samsung', $produto->marca->nome);
    }

    public function test_foreign_key_constraints()
    {
        // Tentar criar produto com categoria_id inexistente
        $this->expectException(\Illuminate\Database\QueryException::class);
        Produto::factory()->create([
            'categoria_id' => 999,
            'marca_id' => 999,
        ]);
    }

    public function test_data_integrity()
    {
        $categoria = Categoria::factory()->create();
        $marca = Marca::factory()->create();
        
        $produto = Produto::factory()->create([
            'nome' => 'Produto Teste',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        // Verificar que os dados estão corretos no banco
        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
            'nome' => 'Produto Teste',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        // Verificar que os timestamps foram criados
        $this->assertNotNull($produto->created_at);
        $this->assertNotNull($produto->updated_at);
    }
} 