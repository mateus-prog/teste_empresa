@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categorias</h1>
        <a href="{{ route('categorias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nova Categoria</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr class="text-center">
                    <th class="py-2 px-4 w-1/12">ID</th>
                    <th class="py-2 px-4 w-10/12 text-left">Nome</th>
                    <th class="py-2 px-4 w-1/12">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-center">{{ $categoria->id }}</td>
                        <td class="py-2 px-4 text-left">{{ $categoria->nome }}</td>
                        <td class="py-2 px-4 flex justify-center gap-2">
                            <button onclick="openModal('view-categoria-{{ $categoria->id }}')" title="Ver">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <a href="{{ route('categorias.edit', $categoria) }}" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 hover:text-yellow-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button onclick="openModal('delete-categoria-{{ $categoria->id }}')" title="Remover">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modais de Visualização -->
    @foreach($categorias as $categoria)
        <div id="view-categoria-{{ $categoria->id }}" class="modal fixed inset-0 z-50 hidden">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h3 class="text-lg font-semibold">Detalhes da Categoria</h3>
                        <button onclick="closeModal('view-categoria-{{ $categoria->id }}')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-600">ID:</label>
                            <p class="text-gray-900">{{ $categoria->id }}</p>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-600">Nome:</label>
                            <p class="text-gray-900">{{ $categoria->nome }}</p>
                        </div>
                        <div class="flex justify-end">
                            <button onclick="closeModal('view-categoria-{{ $categoria->id }}')" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modais de Confirmação de Exclusão -->
    @foreach($categorias as $categoria)
        <div id="delete-categoria-{{ $categoria->id }}" class="modal fixed inset-0 z-50 hidden">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h3 class="text-lg font-semibold">Confirmar Exclusão</h3>
                        <button onclick="closeModal('delete-categoria-{{ $categoria->id }}')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-gray-800">Deseja excluir este registro?</p>
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Sim, excluir</button>
                            </form>
                            <button type="button" onclick="closeModal('delete-categoria-{{ $categoria->id }}')" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection 