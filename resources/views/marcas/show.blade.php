@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Marca: {{ $marca->nome }}</h1>
        <p class="mb-2"><b>ID:</b> {{ $marca->id }}</p>
        <a href="{{ route('marcas.index') }}" class="text-blue-600 hover:underline">Voltar</a>
    </div>
@endsection 