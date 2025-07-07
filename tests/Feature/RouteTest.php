<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_route()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_produtos_routes()
    {
        $this->get('/produtos')->assertStatus(200);
        $this->get('/produtos/create')->assertStatus(200);
        $this->get('/produtos/1')->assertStatus(404); // Produto não existe
        $this->get('/produtos/1/edit')->assertStatus(404); // Produto não existe
    }

    public function test_categorias_routes()
    {
        $this->get('/categorias')->assertStatus(200);
        $this->get('/categorias/create')->assertStatus(200);
        $this->get('/categorias/1')->assertStatus(404); // Categoria não existe
        $this->get('/categorias/1/edit')->assertStatus(404); // Categoria não existe
    }

    public function test_marcas_routes()
    {
        $this->get('/marcas')->assertStatus(200);
        $this->get('/marcas/create')->assertStatus(200);
        $this->get('/marcas/1')->assertStatus(404); // Marca não existe
        $this->get('/marcas/1/edit')->assertStatus(404); // Marca não existe
    }

    public function test_404_for_invalid_routes()
    {
        $this->get('/invalid-route')->assertStatus(404);
    }
} 