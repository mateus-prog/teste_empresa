<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->words(2, true),
            'categoria_id' => Categoria::factory(),
            'marca_id' => Marca::factory(),
        ];
    }
} 