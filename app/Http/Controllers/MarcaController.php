<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.show', compact('marca'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome',
        ]);
        Marca::create($data);
        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome,except,id',
        ]);
        $marca->update($data);
        return redirect()->route('marcas.index')->with('success', 'Marca atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return redirect()->route('marcas.index')->with('success', 'Marca deletada com sucesso!');
    }
} 