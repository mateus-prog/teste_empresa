<?php

namespace Tests\Unit;

use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarcaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_marca()
    {
        $marca = Marca::factory()->create([
            'nome' => 'Marca Teste'
        ]);

        $this->assertDatabaseHas('marcas', [
            'nome' => 'Marca Teste'
        ]);
    }

    public function test_marca_has_many_produtos()
    {
        $marca = Marca::factory()->create();
        $produtos = Produto::factory()->count(3)->create(['marca_id' => $marca->id]);

        $this->assertCount(3, $marca->produtos);
        $this->assertInstanceOf(Produto::class, $marca->produtos->first());
    }

    public function test_marca_fillable_fields()
    {
        $marca = new Marca();
        $fillable = ['nome'];

        $this->assertEquals($fillable, $marca->getFillable());
    }
} 