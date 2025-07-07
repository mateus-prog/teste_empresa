<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::with(['categoria', 'marca']);

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }

        $produtos = $query->get();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('produtos.index', compact('produtos', 'categorias', 'marcas'));
    }

    public function show($id)
    {
        $produto = Produto::with(['categoria', 'marca'])->findOrFail($id);
        return view('produtos.show', compact('produto'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('produtos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:produtos,nome',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
        ]);
        Produto::create($data);
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('produtos.edit', compact('produto', 'categorias', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:produtos,nome,except,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
        ]);
        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso!');
    }
} 