@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Nova Marca</h1>
        <form action="{{ route('marcas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1">Nome:</label>
                <input type="text" name="nome" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
                <a href="{{ route('marcas.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Voltar</a>
            </div>
        </form>
    </div>
@endsection 