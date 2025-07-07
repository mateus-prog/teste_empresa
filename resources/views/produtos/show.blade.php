@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Produto: {{ $produto->nome }}</h1>
        <p class="mb-2"><b>ID:</b> {{ $produto->id }}</p>
        <p class="mb-2"><b>Categoria:</b> {{ $produto->categoria->nome ?? '-' }}</p>
        <p class="mb-4"><b>Marca:</b> {{ $produto->marca->nome ?? '-' }}</p>
        <a href="{{ route('produtos.index') }}" class="text-blue-600 hover:underline">Voltar</a>
    </div>
@endsection 