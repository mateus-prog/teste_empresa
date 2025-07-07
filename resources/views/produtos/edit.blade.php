@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Produto</h1>
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('produtos.update', $produto) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1">Nome:</label>
                <input type="text" name="nome" value="{{ $produto->nome }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1">Categoria:</label>
                <select name="categoria_id" required class="w-full border rounded px-3 py-2">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if($produto->categoria_id == $categoria->id) selected @endif>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1">Marca:</label>
                <select name="marca_id" required class="w-full border rounded px-3 py-2">
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}" @if($produto->marca_id == $marca->id) selected @endif>{{ $marca->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Atualizar</button>
                <a href="{{ route('produtos.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Voltar</a>
            </div>
        </form>
    </div>
@endsection 