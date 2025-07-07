@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Categoria: {{ $categoria->nome }}</h1>
        <p class="mb-2"><b>ID:</b> {{ $categoria->id }}</p>
        <a href="{{ route('categorias.index') }}" class="text-blue-600 hover:underline">Voltar</a>
    </div>
@endsection 